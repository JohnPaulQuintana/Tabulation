<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Category;
use App\Models\Event;
use App\Models\Judge;
use App\Models\PercentageScore;
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

        $eventCategory = Category::with(['subCategory', 'event.judge'])
            ->where('status', true)
            ->first();
            // dd($eventCategory);
        if ($eventCategory) {
            $categoryId = $eventCategory->id;
            $judgeId = Auth::user()->id;
            $candidatesWithVotesInCategory = Candidate::whereHas('votes', function ($query) use ($categoryId, $judgeId) {
                $query->where('category_id', $categoryId)->where('judge_id', $judgeId);
            })->with(['votes' => function ($query) use ($categoryId, $judgeId) {
                $query->select('id', 'candidate_id','judge_id')->where('category_id', $categoryId)->where('judge_id', $judgeId);
            }])
            ->get();

            
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
        // dd($request);
        $criteriaVotes = [];
        $activeCategory = Category::with(['subCategory','event.judge'])->where('status',true)->first();
        $N = count($activeCategory->event->judge);//total judges
        $mpts = $N*100;
        $totalScore = 0;
        // $totalSubPercentage = 0;
        foreach ($activeCategory->subCategory as $key => $criteria) {
            // dd($criteria->sub_category);
            $criteriaVotes[$criteria->sub_category] = floatval($request->criteria[$key]);
            //total percentage for all this category
            // $totalSubPercentage += $criteria->percentage;
            $totalScore += floatval($request->criteria[$key]);
           
        }
        // dd($totalScore);
        $percentage = round(($totalScore / $mpts) * 100, 1);//by default its set to 100%
        // dd($percentage);
        $vote = Vote::create([
                'candidate_id' => $request->candidate_id,
                'judge_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'criteria' => json_encode($criteriaVotes)
            ]);
            // dd($vote);
        if($vote){
            PercentageScore::create([
                'vote_id' => $vote->id,
                'candidate_id' => $request->candidate_id,
                'judge_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'total_score' => $percentage
            ]);
        }

        return Redirect::route('judge.candidates')->with(['status' => true, 'message' => 'Successfully recorded your votes!']);
    }

    //edit
    public function edit(Request $request){
        // dd($request->id);
        $vote = Vote::with(['percentages'])->where('id',$request->id)->first();
        // dd($vote);
        return response()->json(['vote'=>$vote]);
    }
    //update
    public function update(Request $request){
        // dd($request);
        $criteriaVotes = [];
        // $activeCategory = Category::with('subCategory')->where('status',true)->first();
        $activeCategory = Category::with(['subCategory','event.judge'])->where('status',true)->first();
        $N = count($activeCategory->event->judge);//total judges
        $mpts = $N*100;
        $totalScore = 0;
        foreach ($activeCategory->subCategory as $key => $criteria) {
            $criteriaVotes[$criteria->sub_category] = floatval($request->criteria[$key]);
            $totalScore += floatval($request->criteria[$key]);
        }

        $percentage = round(($totalScore / $mpts) * 100, 1);//by default its set to 100%
        $updateVote = Vote::find($request->vote_id)->update(['criteria'=>json_encode($criteriaVotes)]);
       
        if($updateVote){
            $updatePercentage = PercentageScore::where('vote_id',$request->vote_id);
            // dd($updatePercentage);
            $updatePercentage->update(['total_score'=>$percentage]);
        }
        return Redirect::route('judge.candidates')->with(['status' => true, 'message' => 'Successfully recorded your votes!']);
    }
}
