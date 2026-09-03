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
            'name'     => 'required',
            'age'      => 'required|integer|min:1|max:120',
            'role'     => 'required|string|in:admin,employee,super_admin',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['status']   = $data['role'] === 'employee' ? 'pending' : 'approved';

        $user = User::create($data);
        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successful! Please wait for admin approval.' );
        }
    }

    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
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
                return back()->withErrors(['email' => 'Your registration was rejected by the admin.']);
            }

            if ($user->status === 'deactivated') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been deactivated. Contact your admin.']);
            }

            $request->session()->regenerate();
            return redirect()->route(in_array($user->role, ['admin', 'super_admin']) ? 'admin' : 'dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboardPage()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        $project = Project::find(1) ?? new Project([
            'title'       => 'Core System Guidelines',
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
        $employees    = User::where('role', 'employee')->where('status', 'approved')->get();
        $pendingUsers = User::where('status', 'pending')->get();
        $allUsers     = User::orderBy('created_at', 'desc')->get();

        $project = Project::find(1) ?? new Project([
            'title'       => 'Project System Roadmap',
            'description' => 'Add your comprehensive breakdown of the core project guidelines here...'
        ]);

        // Workspace stats: per employee task counts
        $workspaceStats = User::where('role', 'employee')
            ->where('status', 'approved')
            ->with(['tasks'])
            ->get()
            ->map(function ($emp) {
                return [
                    'id'         => $emp->id,
                    'name'       => $emp->name,
                    'email'      => $emp->email,
                    'todo'       => $emp->tasks->where('status', 'To Do')->count(),
                    'inprogress' => $emp->tasks->where('status', 'In Progress')->count(),
                    'completed'  => $emp->tasks->where('status', 'Completed')->count(),
                    'total'      => $emp->tasks->count(),
                ];
            });

        return view('admin', compact('employees', 'project', 'pendingUsers', 'allUsers', 'workspaceStats'));
    }

    public function approve(User $user)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized.');
        }
        if ($user->status === 'pending') {
            $user->update(['status' => 'approved']);
            return redirect(route('admin') . '#userrole')->with('success', "Employee {$user->name} has been approved.");
        }
        return redirect(route('admin') . '#userrole')->withErrors(['error' => 'Invalid action.']);
    }

    public function reject(User $user)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized.');
        }
        if ($user->status === 'pending') {
            $user->update(['status' => 'rejected']);
            return redirect(route('admin') . '#userrole')->with('success', "Employee {$user->name} has been rejected.");
        }
        return redirect(route('admin') . '#userrole')->withErrors(['error' => 'Invalid action.']);
    }

    public function changeRole(Request $request, User $user)
    {
        $currentUser = Auth::user();
        if (!in_array($currentUser->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized.');
        }

        // Prevent admin from changing their own role
        if ($user->id === $currentUser->id) {
            return redirect(route('admin') . '#userrole')->withErrors(['error' => 'You cannot change your own role.']);
        }

        // Only super_admin can change role of admin/super_admin or grant admin/super_admin role
        if ($currentUser->role !== 'super_admin') {
            if (in_array($user->role, ['admin', 'super_admin'])) {
                return redirect(route('admin') . '#userrole')->withErrors(['error' => 'You cannot change the role of an admin or super admin.']);
            }
            if (in_array($request->role, ['admin', 'super_admin'])) {
                return redirect(route('admin') . '#userrole')->withErrors(['error' => 'You cannot assign admin or super admin roles.']);
            }
        }

        $request->validate([
            'role' => 'required|in:admin,employee,super_admin',
        ]);

        $user->update(['role' => $request->role]);
        return redirect(route('admin') . '#userrole')->with('success', "{$user->name}'s role updated to {$request->role}.");
    }

    public function deactivate(User $user)
    {
        $currentUser = Auth::user();
        if (!in_array($currentUser->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized.');
        }
        if ($user->id === $currentUser->id) {
            return redirect(route('admin') . '#userrole')->withErrors(['error' => 'You cannot deactivate your own account.']);
        }
        if ($currentUser->role !== 'super_admin' && in_array($user->role, ['admin', 'super_admin'])) {
            return redirect(route('admin') . '#userrole')->withErrors(['error' => 'You cannot deactivate an admin or super admin.']);
        }
        
        $user->update(['status' => 'deactivated']);
        return redirect(route('admin') . '#userrole')->with('success', "{$user->name}'s account has been deactivated.");
    }

    public function reactivate(User $user)
    {
        $currentUser = Auth::user();
        if (!in_array($currentUser->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized.');
        }
        if ($currentUser->role !== 'super_admin' && in_array($user->role, ['admin', 'super_admin'])) {
            return redirect(route('admin') . '#userrole')->withErrors(['error' => 'You cannot reactivate an admin or super admin.']);
        }
        $user->update(['status' => 'approved']);
        return redirect(route('admin') . '#userrole')->with('success', "{$user->name}'s account has been reactivated.");
    }
}