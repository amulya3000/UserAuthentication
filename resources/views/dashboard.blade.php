<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Workspace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col">

    <!-- Navigation Header -->
    <header class="bg-slate-900 text-white shadow-md border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-600 p-2 rounded-lg text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-tight">System Workspace Hub</h1>
                    <span class="text-xs text-slate-400">Employee Workspace Node</span>
                </div>
            </div>

            <!-- Profile and Log Out Actions -->
            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-slate-100">{{ Auth::user()->name }}</p>
                    <span class="text-xs text-blue-400 font-medium capitalize">{{ Auth::user()->role }} Workspace</span>
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

        <!-- Workspace Informational Header -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Welcome back, {{ Auth::user()->name }}!</h2>
                <p class="text-sm text-slate-500 mt-1">Manage assignments and review key system specs broadcasted from administration.</p>
            </div>
            
            <div class="flex items-center gap-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                <div class="bg-slate-50 border border-slate-100 p-3 rounded-lg text-center">
                    <span class="block text-lg font-bold text-slate-800">{{ $tasks->where('status', 'To Do')->count() }}</span>
                    Pending Tasks
                </div>
                <div class="bg-slate-50 border border-slate-100 p-3 rounded-lg text-center">
                    <span class="block text-lg font-bold text-slate-800">{{ $tasks->where('status', 'In Progress')->count() }}</span>
                    In Progress
                </div>
            </div>
        </div>

        <!-- Active Project Briefing Panel (Admin Description) -->
        <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-xs">
            <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-100">
                <span class="p-1.5 bg-blue-50 text-blue-600 rounded-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </span>
                <h3 class="text-md font-bold text-slate-900">{{ $project->title }}</h3>
            </div>
            
            <!-- Long Form Content Render -->
            <div class="text-sm text-slate-600 leading-relaxed max-h-[220px] overflow-y-auto bg-slate-50 p-4 rounded-lg border border-slate-100 whitespace-pre-line">
                {{ $project->description }}
            </div>
        </section>

        <!-- The Split Container Board Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            
            <!-- ================= TO DO LANE ================= -->
            <div class="bg-slate-100/70 p-5 rounded-2xl border border-slate-200/80 min-h-[400px] space-y-4">
                <div class="flex items-center justify-between border-b border-slate-200/60 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 bg-indigo-500 rounded-full"></span>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-600">Assigned Queue (To Do)</h3>
                    </div>
                    <span class="bg-slate-200 text-slate-700 text-xs px-2.5 py-0.5 rounded-full font-bold">
                        {{ $tasks->where('status', 'To Do')->count() }}
                    </span>
                </div>
                
                <div class="space-y-3">
                    @forelse($tasks->where('status', 'To Do') as $task)
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs hover:border-slate-300 transition group">
                            <div class="flex items-start justify-between gap-3">
                                <h4 class="text-sm font-semibold text-slate-900 group-hover:text-blue-600 transition leading-snug">
                                    {{ $task->title }}
                                </h4>
                                
                                @if($task->priority === 'High')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200/60 uppercase">High</span>
                                @elseif($task->priority === 'Medium')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60 uppercase">Medium</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 uppercase">Low</span>
                                @endif
                            </div>
                            
                            <!-- Dynamic Task Assignment Description Display -->
                            @if($task->description)
                                <div class="mt-3 text-xs text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-100/80 leading-relaxed whitespace-pre-line">
                                    {{ $task->description }}
                                </div>
                            @endif
                            
                            <div class="flex justify-between items-center mt-5 pt-3 border-t border-slate-50">
                                <span class="text-xs text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Management Mandate
                                </span>
                                
                                <form action="{{ route('tasks.status', $task->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="status" value="In Progress">
                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-800 cursor-pointer hover:underline transition">
                                        Start Development &rarr;
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 px-4 border-2 border-dashed border-slate-200 rounded-xl bg-white/50">
                            <span class="text-slate-300 flex justify-center mb-3">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138z"></path>
                                </svg>
                            </span>
                            <h4 class="text-sm font-semibold text-slate-700">All Queue Lanes Cleared</h4>
                            <p class="text-xs text-slate-400 mt-1">There are no pending workflow parameters assigned to your desk.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- ================= IN PROGRESS LANE ================= -->
            <div class="bg-slate-100/70 p-5 rounded-2xl border border-slate-200/80 min-h-[400px] space-y-4">
                <div class="flex items-center justify-between border-b border-slate-200/60 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 bg-blue-500 rounded-full animate-ping"></span>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-600">Active Development (Processing)</h3>
                    </div>
                    <span class="bg-slate-200 text-slate-700 text-xs px-2.5 py-0.5 rounded-full font-bold">
                        {{ $tasks->where('status', 'In Progress')->count() }}
                    </span>
                </div>
                
                <div class="space-y-3">
                    @forelse($tasks->where('status', 'In Progress') as $task)
                        <div class="bg-white p-5 rounded-xl border-l-4 border-l-blue-600 border border-slate-200 shadow-xs">
                            <div class="flex items-start justify-between gap-3">
                                <h4 class="text-sm font-semibold text-slate-900 leading-snug">
                                    {{ $task->title }}
                                </h4>
                                
                                @if($task->priority === 'High')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200/60 uppercase">High</span>
                                @elseif($task->priority === 'Medium')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60 uppercase">Medium</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 uppercase">Low</span>
                                @endif
                            </div>

                            <!-- Displaying the custom Admin-typed Task Description in the processing container card -->
                            @if($task->description)
                                <div class="mt-3 text-xs text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-100/80 leading-relaxed whitespace-pre-line">
                                    {{ $task->description }}
                                </div>
                            @endif
                            
                            <div class="flex justify-between items-center mt-5 pt-3 border-t border-slate-50">
                                <span class="text-xs text-blue-600 font-semibold flex items-center gap-1.5 animate-pulse">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                    Compilation Active
                                </span>
                                
                                <form action="{{ route('tasks.status', $task->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="status" value="Completed">
                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-800 cursor-pointer hover:underline transition">
                                        Mark Completed ✓
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 px-4 border-2 border-dashed border-slate-200 rounded-xl bg-white/50">
                            <span class="text-slate-300 flex justify-center mb-3">
                                <svg class="w-10 h-10 animate-spin text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.9 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.9-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </span>
                            <h4 class="text-sm font-semibold text-slate-700">Pipeline Idle</h4>
                            <p class="text-xs text-slate-400 mt-1">Select an item from the queue board and click 'Start Development' to pull workspace parameters here.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>
</body>
</html> 