<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BacklogController extends Controller
{
    public function index() {
        $backlogs = DB::table('backlogs')->whereNull('sprint')->latest()->get();
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
        return back()->with('success', 'Task removed successfully!');
    }

    public function sprintIndex() {
        // Fetch backlogs that belong to a sprint (e.g. Sprint 1)
        $sprintBacklogs = DB::table('backlogs')->where('sprint', 'Sprint 1')->latest()->get();
        return view('Sprint', compact('sprintBacklogs'));
    }

    public function storeSprintItem(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:Story,Task,Bug'
        ]);
        
        $count = DB::table('backlogs')->count() + 1;
        $taskId = 'CREAT-' . $count;   
        
        DB::table('backlogs')->insert([
            'task_id' => $taskId,
            'title' => $request->title,
            'type' => $request->type,
            'sprint' => 'Sprint 1',
            'status' => 'To Do',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->route('sprint')->with('success', 'Issue added to sprint!');
    }

    public function scrumIndex() {
        $sprintBacklogs = DB::table('backlogs')->whereNotNull('sprint')->get();
        return view('Scrum', compact('sprintBacklogs'));
    }

    public function updateStatus(Request $request, $id) {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Done'
        ]);

        DB::table('backlogs')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('scrum')->with('success', 'Status updated successfully!');
    }
}
