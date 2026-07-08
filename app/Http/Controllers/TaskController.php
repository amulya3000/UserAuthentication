<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use GuzzleHttp\Psr7\Request;
use Illuminate\Container\Attributes\Auth;

Class TaskController extends Controller{
    public function store(Request $request){
        if(Auth::user()->role !== 'admin'){
            \abort(403,'Unauthorized action');
        }
    
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
        'priority' => 'required|in:low,Medium,high',
    ]);

    Task::create(Task);

    return back()->with('success, Task successfully deployed to employee container'); 

}

public function updateStatus(Task $task, Request $request){
    if(Auth::id() !== $task->user_is){
        \abort(403,'You can only manage tasks assigned to your own workspace.');

        $request->valide([
            'status' => 'required|in:To Do, In Progress, Completed'
        ]);
        $task->update(['status'=> $request->status]);
        return back();
    }
}
}