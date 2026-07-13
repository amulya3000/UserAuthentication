<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registration(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'age' => 'required|integer|min:1|max:120',
            'role' => 'required|string|in:admin,employee',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['status'] = $data['role'] === 'employee' ? 'pending' : 'approved';

        $user = User::create($data);
        if ($user) {
            return redirect()->route('login');
        }
    }
    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status === 'pending') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is awaiting admin approval.']);
            }

            if ($user->status === 'rejected') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your registration was rejected.']);
            }

            $request->session()->regenerate();
            return redirect()->route($user->role === 'admin' ? 'admin' : 'dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboardPage()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

      
        $project = Project::find(1) ?? new Project([
            'title' => 'Core System Guidelines',
            'description' => 'The admin has not posted project details yet.'
        ]);

        return view('dashboard', compact('tasks', 'project'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function index()
    {
        // Fetch approved employees so admin can assign tasks to them
        $employees = User::where('role', 'employee')->where('status', 'approved')->get();
        
        // Fetch pending employees for approval
        $pendingUsers = User::where('status', 'pending')->get();

        // Fetch project or fallback to default layout
        $project = Project::find(1) ?? new Project([
            'title' => 'Project System Roadmap',
            'description' => 'Add your comprehensive breakdown of the core project guidelines here (supports up to 2,000 words)...'
        ]);

        return view('admin', compact('employees', 'project', 'pendingUsers'));
    }

    public function approve(User $user)
    {
        if ($user->status === 'pending') {
            $user->update(['status' => 'approved']);
            return back()->with('success', "Employee {$user->name} has been approved.");
        }
        return back()->withErrors(['error' => 'Invalid action.']);
    }

    public function reject(User $user)
    {
        if ($user->status === 'pending') {
            $user->update(['status' => 'rejected']);
            return back()->with('success', "Employee {$user->name} has been rejected.");
        }
        return back()->withErrors(['error' => 'Invalid action.']);
    }
}