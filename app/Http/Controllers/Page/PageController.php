<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $events = Event::orderByDesc('created_at')->get();
        return view('welcome', compact('events'));
    }
}
