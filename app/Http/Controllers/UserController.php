<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
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
            return redirect()->route('admin'); // or 'dashboard' — pick one, see note below
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboardPage()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('dashboard', compact('tasks'));
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
        $pendingUsers = User::where('status', 'pending')->get();
        $employees = User::where('role', 'employee')->where('status', 'approved')->get();
        return view('admin', compact('pendingUsers', 'employees'));
    }

    public function approve(User $user)
    {
        $user->update(['status' => 'approved']);
        return back()->with('success', "{$user->name} approved.");
    }

    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('success', "{$user->name} rejected.");
    }



}