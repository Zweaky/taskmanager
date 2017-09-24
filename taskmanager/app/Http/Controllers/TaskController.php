<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show','search']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::where('user_id','=',auth()->user()->id)->orderBy('starttime','asc')->get();
        return view('tasks',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newtask');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create(array(
            'description' => $request->get('description'),
            'starttime' => $request->get('starttime'),
            'endtime' => $request->get('endtime'),
            'user_id' => auth()->id(),
            'public' => $request->get('public')? true:false,
            'team_id' => $request->get('team_id'),
        ));

        return redirect('/task');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('showtask',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('updatetask',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->description = $request->get('description');
        $task->starttime = $request->get('starttime');
        $task->endtime = $request->get('endtime');
        $task->user_id = auth()->id();
        $task->public = $request->get('public')? true:false;
        $task->team_id = $request->get('team_id');
        $task->status = $request->get('status_id');
        $task->save();

        return redirect('/task');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/task');
    }

    public function mark(Task $task)
    {
        $task->status = !$task->status;
        $task->save();

        return redirect('/task');
    }

    public function getTaskYears(Request $request,String $year) 
    {
        $year = intval($year);

        if (!is_numeric($year)) 
        {
            return array();
        }

        //$count = DB::table('tasks')->where('user_id',auth()->user()->id)->where(DB::raw('YEAR(starttime)'),$year)->select(DB::raw('YEAR(starttime) as varYear'),DB::raw('count(starttime) as count'))->groupBy('varYear')->get()->first()->count;
 
        $countMonths = DB::table('tasks')->where('user_id',auth()->user()->id)->where(DB::raw('YEAR(starttime)'),"$year")->select(DB::raw('MONTH(starttime) as varMonth'),DB::raw('count(starttime) as count'))->groupBy('varMonth')->get();

        $result = array();

        for ($i = 0;$i < 12;$i++) {

            $result[$i] = 0;

            foreach($countMonths as $month) {
                if ($month->varMonth == strval($i)) {
                    $result[$i] = $month->count;
                    break;
                }
            }
        }

        return json_encode($result);
    }

    public function getYears() 
    {
        $years = DB::table('tasks')->select(DB::raw('YEAR(starttime) as year'))->get()->unique();

        return $years;
    }
}
