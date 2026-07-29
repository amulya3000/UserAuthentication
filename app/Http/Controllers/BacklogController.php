<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sprint;
use App\Models\Backlog;

class BacklogController extends Controller
{
    public function index() {
        $backlogs = DB::table('backlogs')->whereNull('sprint_id')->latest()->get();
        return view('backlog', compact('backlogs'));
    }

    public function store(Request $request){
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

    // --- Sprints ---

    public function sprintIndex() {
        $sprints = Sprint::with('backlogs')->latest()->get();
        return view('Sprint', compact('sprints'));
    }

    public function storeSprint(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Sprint::create([
            'name' => $request->name,
            'is_active' => false
        ]);

        return back()->with('success', 'New sprint created!');
    }

    public function updateSprint(Request $request, $id) {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $sprint = Sprint::findOrFail($id);

        if ($request->has('is_active') && $request->is_active) {
            // Deactivate other sprints if this one becomes active
            Sprint::where('id', '!=', $id)->update(['is_active' => false]);
            $sprint->is_active = true;
        }

        $sprint->start_date = $request->start_date;
        $sprint->end_date = $request->end_date;
        $sprint->notes = $request->notes;
        $sprint->save();

        return back()->with('success', 'Sprint updated!');
    }

    public function storeSprintItem(Request $request, $sprint_id){
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:Story,Task,Bug'
        ]);
        
        $count = DB::table('backlogs')->count() + 1;
        $taskId = 'CREAT-' . $count;   
        
        Backlog::create([
            'task_id' => $taskId,
            'title' => $request->title,
            'type' => $request->type,
            'sprint_id' => $sprint_id,
            'status' => 'To Do'
        ]);
        
        return back()->with('success', 'Issue added to sprint!');
    }

    // --- Scrum Board ---

    public function scrumIndex() {
        $activeSprint = Sprint::with('backlogs')->where('is_active', true)->first();
        
        if (!$activeSprint) {
            $sprintBacklogs = collect();
        } else {
            $sprintBacklogs = $activeSprint->backlogs;
        }

        return view('Scrum', compact('sprintBacklogs', 'activeSprint'));
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
