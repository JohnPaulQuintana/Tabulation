<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Judge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JudgeController extends Controller
{
    //authenticate
    public function index(){
        $id = auth()->user()->id;
        $judgeWithEvent = Judge::with('event')->where('user_id',$id)->first();
        // dd($judgeWithEvent);
        return view('judge.index', compact('judgeWithEvent'));
    }

    // display candidates
    public function candidates(){
        // active events
        $activeEvent = Event::with(['category', 'candidates'])
            ->where('status', true)
            ->whereHas('category', function ($query) {
                $query->where('status', true);
            })
            ->first();
        // dd($activeEvent);

        $eventCategory = Event::with('category.subCategory')
            ->where('status', true)
            ->whereHas('category', function ($q) {
                $q->where('status', true)
                ->whereHas('subCategory', function ($q) {
                    $q->where('status', true);
                });
            })
            ->first();

        dd($eventCategory);
        if (!$activeEvent) {
            return Redirect::route('judge.dashboard')->with(['response'=>"Event is not ready yet, wait for the event to start."]);
        }
        return view('judge.candidate', compact('activeEvent', 'eventCategory'));
    }
}
