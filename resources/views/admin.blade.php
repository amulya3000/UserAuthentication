<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <!-- Tailwind CSS for modern design and responsiveness -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="h-full flex flex-col">

    <!-- Top Navigation Header -->
    <header class="bg-slate-900 text-white shadow-md border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-600 p-2 rounded-lg text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-tight">System Workspace Hub</h1>
                    <span class="text-xs text-slate-400">Administrative Control Node</span>
                </div>
            </div>

            <!-- Profile and Log Out Actions -->
            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-slate-100">{{ Auth::user()->name }}</p>
                    <span class="text-xs text-emerald-400 font-medium">Active Administrator</span>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white px-3 py-2 rounded-lg text-xs font-semibold transition cursor-pointer">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Page Content Wrap -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- Flash Message Alerts -->
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-3">
                <span class="text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </span>
                <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-50 border border-red-200">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-red-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                    <h3 class="text-sm font-semibold text-red-800">Deployment Error Detected</h3>
                </div>
                <ul class="list-disc list-inside text-xs text-red-700 pl-8 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Primary Workspace Action Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- SECTION 1: MANUAL WORKFLOW DIVISION PANEL -->
            <section class="lg:col-span-5 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-md font-semibold text-slate-900">Task Allocation Engine</h2>
                    <p class="text-xs text-slate-500 mt-1">Deploy segmented workflow structures directly into assigned employee dashboard containers.</p>
                </div>

                <div class="p-6">
                    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Task Name Selection -->
                        <div>
                            <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Select Blueprint Scope</label>
                            <select id="title" name="title" required class="w-full text-sm rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none">
                                <option value="" disabled selected>Choose an active workspace task...</option>
                                <option value="Optimize Backend Queries">Optimize Backend Queries</option>
                                <option value="Build Docker Deployment Configuration">Build Docker Deployment Configuration</option>
                                <option value="Review UI Component Accessibility">Review UI Component Accessibility</option>
                                <option value="Refactor API Routing Parameters">Refactor API Routing Parameters</option>
                            </select>
                        </div>

                        <!-- Target Employee Designation -->
                        <div>
                            <label for="user_id" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Assign To Employee</label>
                            <select id="user_id" name="user_id" required class="w-full text-sm rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none">
                                <option value="" disabled selected>Choose an approved employee workspace...</option>
                                @forelse($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @empty
                                    <option value="" disabled>No active employees registered yet.</option>
                                @endforelse
                            </select>
                        </div>

                        <!-- Priority Configuration Tiers -->
                        <div>
                            <label for="priority" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Priority Classification</label>
                            <select id="priority" name="priority" required class="w-full text-sm rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none">
                                <option value="Low">Low Priority Worksite</option>
                                <option value="Medium" selected>Medium Priority Worksite</option>
                                <option value="High">High Priority Worksite</option>
                            </select>
                        </div>

                        <!-- Submit Form Button -->
                        <button type="submit" class="w-full bg-slate-950 hover:bg-slate-800 text-white font-medium text-sm py-3 rounded-lg shadow-md transition cursor-pointer flex items-center justify-center gap-2">
                            Deploy Workflow Container &rarr;
                        </button>
                    </form>
                </div>
            </section>

            <!-- SECTION 2: REGISTRATION APPROVAL QUEUE -->
            <section class="lg:col-span-7 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-md font-semibold text-slate-900">User Approvals</h2>
                    <p class="text-xs text-slate-500 mt-1">Audit onboarding credentials of employees awaiting activation inside the system database.</p>
                </div>

                <div class="p-6">
                    @if($pendingUsers->isEmpty())
                        <div class="text-center py-12 px-4 border-2 border-dashed border-slate-200 rounded-lg">
                            <span class="text-slate-300 flex justify-center mb-3">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </span>
                            <h3 class="text-sm font-semibold text-slate-700">All Registration Queues Clear</h3>
                            <p class="text-xs text-slate-400 mt-1">No pending employee verification requests await admin processing at this time.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-200">
                                        <th class="pb-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Candidate Details</th>
                                        <th class="pb-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Role Requested</th>
                                        <th class="pb-3 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Decision Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($pendingUsers as $user)
                                        <tr class="hover:bg-slate-50/50 transition">
                                            <td class="py-4">
                                                <div class="font-semibold text-sm text-slate-900">{{ $user->name }}</div>
                                                <div class="text-xs text-slate-400">{{ $user->email }}</div>
                                            </td>
                                            <td class="py-4">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200/60 capitalize">
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                            <td class="py-4 text-right">
                                                <div class="inline-flex gap-2">
                                                    <!-- Approve Onboarding Credentials -->
                                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-semibold px-3 py-1.5 rounded-md transition cursor-pointer">
                                                            Approve
                                                        </button>
                                                    </form>

                                                    <!-- Reject Registration Request -->
                                                    <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 text-xs font-semibold px-3 py-1.5 rounded-md transition cursor-pointer">
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </section>

        </div>

    </main>

</body>
</html>