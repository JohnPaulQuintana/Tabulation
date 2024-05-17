<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class Administrator extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function event(){
        return view('admin.event');
    }
    public function create(){
        return view('admin.event.create');
    }
}
