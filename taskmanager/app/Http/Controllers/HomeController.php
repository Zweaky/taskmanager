<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = array(
            'tasks_all_count' => Task::where('user_id',auth()->user()->id)->count(),
            'tasks_pending_count' => Task::where('user_id',auth()->user()->id)->where('status',0)->count(),
            'tasks_done_count' => Task::where('user_id',auth()->user()->id)->where('status',1)->count(), 
        );
        
        return view('home',compact("parameters"));
    }
}
