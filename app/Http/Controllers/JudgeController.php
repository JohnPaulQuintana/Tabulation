<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Judge;
use Illuminate\Http\Request;

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
        $activeEvent = Event::with(['category', 'candidates'])->where('status', true)->first();
        // dd($activeEvent);
        return view('judge.candidate', compact('activeEvent'));
    }
}
