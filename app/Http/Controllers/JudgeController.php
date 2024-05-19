<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    //authenticate
    public function authenticate(Request $request){
        $validated = $request->validate(['code'=>'required']);
        // dd($request);

        // Check if a judge with the provided code exists
        $judge = Judge::with('event')->where('code', $validated['code'])->first();
        // dd($judge);
        if ($judge) {
            // Authentication successful, return a success message
           return view('judge.index', compact('judge'));
        } else {
            // Authentication failed, return an error message
            return response()->json(['message' => 'Invalid code'], 401);
        }
    }
}
