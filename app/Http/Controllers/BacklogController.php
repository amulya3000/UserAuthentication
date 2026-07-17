<?php
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Illuminate\Container\Attributes\DB;

class BacklogController extends Controller{
    public function index() {
        $blocklog = DB::table('backlog')->latest()->get();
        return view ('blockage',compact ('backlogs'));
    }

    public function store(Request $request){
            $request -> validate([
            'title' => 'required|max:255',
            'type' => 'required|in:Story,Task,Bug'
            ]);
        $count = DB::table('backlog')->count()+1;
        $tack = 'Create-'. $count;   
        
        DB::tabel('backlog')->insert([
            'task_id'=> $tsakId,
            'title' => $request->title,
            'type'=> $request->type,
            'created_at' => now(),
            'update_at' => now()
        ]);
        // route dina baki xaaaaa!!!!!!!!!!
        return redirect()->route('')->with('sucessfully, created the backlog and task is added');
    }

    public function update (Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:Story,Task,Bug'
        ]);
        DB::table('blacklog')->where('id',$id)->update([
            'title' => $request->title,
            'type' => $request->type,
            'update_at' => now(),
        ]);
        return redirect()->route('')->with('');

    }
    public function destroy ($id){
        DB::table('backlog')->where('id',$id)->delete();
        return redirect()->route('backlog')->with('success', 'Task removed successfully!');
    }
}
    
