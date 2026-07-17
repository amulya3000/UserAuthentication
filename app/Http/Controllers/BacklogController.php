<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BacklogController extends Controller
{
    public function index() {
        $backlogs = DB::table('backlogs')->latest()->get();
        return view('backlog', compact('backlogs'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:Story,Task,Bug'
        ]);
        
        $count = DB::table('backlogs')->count() + 1;
        $taskId = 'Create-' . $count;   
        
        DB::table('backlogs')->insert([
            'task_id' => $taskId,
            'title' => $request->title,
            'type' => $request->type,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->route('backlog')->with('success', 'Successfully created the backlog and task is added');
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:Story,Task,Bug'
        ]);

        DB::table('backlogs')->where('id', $id)->update([
            'title' => $request->title,
            'type' => $request->type,
            'updated_at' => now(),
        ]);

        return redirect()->route('backlog')->with('success', 'Task updated successfully!');
    }

    public function destroy($id){
        DB::table('backlogs')->where('id', $id)->delete();
        return redirect()->route('backlog')->with('success', 'Task removed successfully!');
    }
}
    
