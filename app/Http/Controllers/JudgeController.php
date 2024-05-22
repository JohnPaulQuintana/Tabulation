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
        return view('judge.index', compact('judgeWithEvent'));
    }
}
