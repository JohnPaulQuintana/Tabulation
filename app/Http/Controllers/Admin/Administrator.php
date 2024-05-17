<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\FlareClient\View;

class Administrator extends Controller
{
    public function index(){
        $events = Event::orderByDesc('created_at')->get();
        return view('admin.index', compact('events'));
    }

    public function event(){
        return view('admin.event');
    }
    public function create(){
        return view('admin.event.create');
    }

    // add events
    public function store(Request $request){
        // dd($request);

        $validated = $request->validate([
            'event_name' => 'required',
            'event_details' => 'required',
            'event_type' => 'required',
            'event_image' => 'required',
        ]);

        if($request->hasFile('event_image')){
             // Store the uploaded file and update the user's profile picture
             $path = $request->file('event_image')->store('images', 'public');

             Event::create([
                'name'=>$validated['event_name'],
                'details'=>$validated['event_details'],
                'type'=>$validated['event_type'],
                'image'=>$path,
             ]);
             return Redirect::route('admin.create')->with('status', 'success'); 
        }

    }
}
