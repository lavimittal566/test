<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
    $tasks = Task::where('status',0)->get();
    return view('list',compact('tasks'));
    }

    public function showAllTask()
    {
        $tasks = Task::all();
        return view('list-new',compact('tasks'));
    }

    public function store(Request $request)
    {
         $request->validate([
        'task' => 'required|unique:tasks,name'
         ]);

        $task = Task::create([
        'name' => $request->task,
        'status' => 0,
        ]);
        if($task->status == 0){
            $status = "Non completed";
        }
       
        $html = '<tr id="'.$task->id.'">
                <td><input type="checkbox" class="markComplete" id="' . $task->id . '"></td>
                <td>'.$task->id.'</td>
                <td>'.$task->name.'</td>
                <td>'.$status.'</td>
                <td>
                    <button class="deleteTask" id="'.$task->id.'">Delete</button>
                </td>
             </tr>';
        return response()->json(['html' => $html]);
    }

    public function destroy($id)
    {
        $task = Task::where('id',$id)->delete();
        return response()->json(['status' => 'success']);
    }

    public function stausUpdate($id)
    {  
        $task = Task::find($id);

        if(!empty($task)){
            $task->update(['status' => 1]);
        }
       return response()->json(['status' => 'success']);
    }


}
