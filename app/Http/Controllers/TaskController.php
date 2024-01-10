<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $projects = Project::where('user_id', '=', $user->user_id)->get(); 
        
        $tasks    = Task::with(['project'])
            ->where('user_id', '=', $user->user_id)
            ->orderBy('priority', 'asc')
            ->get();

        return view('tasks.index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $projects = Project::where('user_id', '=', $user->user_id)->get();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'project_id' => 'nullable|exists:projects,project_id',
        ]);

        $user = Auth::user();
        $maxPrioroty = Task::max('priority') ?: 0;
        
        $newTask             = new Task();
        $newTask->name       = $request->name;
        $newTask->user_id    = $user->user_id;
        $newTask->project_id = intval($request->project_id);
        $newTask->priority   = ++$maxPrioroty;

        $newTask->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $task     = Task::findOrFail($id);
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'name'       => 'required',
            'project_id' => 'nullable|exists:projects,project_id',
        ]);

        $task->name       = $request->name;
        $task->project_id = intval($request->project_id);

        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        Task::where('priority', '>', $task->priority)
            ->update(['priority' => \DB::raw('priority - 1')]);

        $task->delete();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setPriority(Request $request){

        $task = Task::findOrFail($request->input('task_id'));
        $prev = Task::find( $request->input('prev_id') );

        if( !$request->input('prev_id') ){            
            $currentDestination = 1;

        }else if( !$request->input('next_id') ){
            $currentDestination = Task::count();
        }else{
            $currentDestination = $task->priority < $prev->priority ? $prev->priority : $prev->priority + 1;
        }

        Task::where('priority', '>', $task->priority)
            ->where('priority', '<=', $currentDestination)
            ->update(['priority' => \DB::raw('priority - 1')]);

        Task::where('priority', '<', $task->priority)
            ->where('priority', '>=', $currentDestination)
            ->update(['priority' => \DB::raw('priority + 1')]);

        $task->priority = $currentDestination;
        $task->save();

        return response()->json(true);
    }
}
