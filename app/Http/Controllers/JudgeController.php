<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Category;
use App\Models\Event;
use App\Models\Judge;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class JudgeController extends Controller
{
    //authenticate
    public function index()
    {
        $id = auth()->user()->id;
        $judgeWithEvent = Judge::with('event')->where('user_id', $id)->first();
        // dd($judgeWithEvent);
        return view('judge.index', compact('judgeWithEvent'));
    }

    // display candidates
    public function candidates()
    {
        // active events
        $activeEvent = Event::with(['category', 'candidates'])
            ->where('status', true)
            ->whereHas('category', function ($query) {
                $query->where('status', true);
            })
            ->first();

        $eventCategory = Category::with('subCategory')
            ->where('status', true)
            ->first();

        if ($eventCategory) {
            $candidatesWithVotesInCategory = Candidate::whereHas('votes', function ($query) use ($eventCategory) {
                $query->where('category_id', $eventCategory->id)->where('judge_id', Auth::user()->id);
            })->get();
        }

        // dd($candidatesWithVotesInCategory);

        if (!$activeEvent) {
            return Redirect::route('judge.dashboard')->with(['response' => "Event is not ready yet, wait for the event to start."]);
        }
        return view('judge.candidate', compact('activeEvent', 'eventCategory', 'candidatesWithVotesInCategory'));
    }

    //vote
    public function vote(Request $request)
    {
        $criteriaVotes = [];
        $activeCategory = Category::with('subCategory')->where('status',true)->first();
        // dd($request->criteria);
        foreach ($activeCategory->subCategory as $key => $criteria) {
            $criteriaVotes[$criteria->sub_category] = intval($request->criteria[$key]);
        }
        // dd($criteriaVotes);
        Vote::create([
            'candidate_id' => $request->candidate_id,
            'judge_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'criteria' => json_encode($criteriaVotes)
        ]);

        return Redirect::route('judge.candidates')->with(['status' => true, 'message' => 'Successfully recorded your votes!']);
    }
}
