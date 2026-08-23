<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Workspace — System Workspace Hub</title>
    <meta name="description" content="Your personal employee workspace for task management and productivity.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .panel { display: none; }
        .panel.active { display: block; }
        .nav-link.active-nav { background: #ecfdf5; color: #047857; font-weight: 600; }
        .ring-timer { transition: stroke-dashoffset 1s linear; }
    </style>
</head>
<body class="h-full flex flex-col">

    <!-- Navigation Header -->
    <header class="bg-emerald-950 text-white shadow-md border-b border-emerald-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-emerald-600 p-2 rounded-lg text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-tight">System Workspace Hub</h1>
                    <span class="text-xs text-slate-400">Employee Workspace Node</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-slate-100">{{ Auth::user()->name }}</p>
                    <span class="text-xs text-emerald-400 font-medium capitalize">{{ Auth::user()->role }} Workspace</span>
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

    <!-- Two-Column Layout -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 flex flex-col md:flex-row gap-6">

        <!-- ====== LEFT SIDEBAR ====== -->
        <aside class="w-full md:w-64 shrink-0 space-y-2">
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs sticky top-22">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-3">Navigation Menu</p>
                <nav class="space-y-1">
                    <a href="{{ route('backlog') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        Project Setup
                    </a>

                    <!-- Pomodoro nav -->
                    <a href="#" onclick="showPanel(event,'panel-pomodoro')" id="nav-pomodoro" class="nav-link flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Pomodoro
                    </a>

                    <!-- Daily Board nav -->
                    <a href="#" onclick="showPanel(event,'panel-daily')" id="nav-daily" class="nav-link flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                        </svg>
                        Daily Board
                    </a>

                    <!-- Private Notes nav -->
                    <a href="#" onclick="showPanel(event,'panel-notes')" id="nav-notes" class="nav-link flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Private Notes
                    </a>

                    <!-- Admin Notes nav -->
                    <a href="#" onclick="showPanel(event,'panel-adminnotes')" id="nav-adminnotes" class="nav-link flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        Admin Notes
                    </a>
                </nav>
            </div>
        </aside>

        <!-- ====== MAIN CONTENT PANELS ====== -->
        <div class="flex-1 space-y-6">

            <!-- ===== DAILY BOARD PANEL (default) ===== -->
            <div id="panel-daily" class="panel active space-y-6">

                <!-- Header -->
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

                <!-- Project Briefing -->
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-xs">
                    <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-100">
                        <span class="p-1.5 bg-emerald-50 text-emerald-600 rounded-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </span>
                        <h3 class="text-md font-bold text-slate-900">{{ $project->title }}</h3>
                    </div>
                    <div class="text-sm text-slate-600 leading-relaxed max-h-[220px] overflow-y-auto bg-slate-50 p-4 rounded-lg border border-slate-100 whitespace-pre-line">
                        {{ $project->description }}
                    </div>
                </section>

                <!-- Task Lanes -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

                    <!-- TO DO -->
                    <div class="bg-slate-100/70 p-5 rounded-2xl border border-slate-200/80 min-h-[400px] space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></span>
                                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-600">Assigned Queue (To Do)</h3>
                            </div>
                            <span class="bg-slate-200 text-slate-700 text-xs px-2.5 py-0.5 rounded-full font-bold">{{ $tasks->where('status', 'To Do')->count() }}</span>
                        </div>
                        <div class="space-y-3">
                            @forelse($tasks->where('status', 'To Do') as $task)
                                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs hover:border-slate-300 transition group">
                                    <div class="flex items-start justify-between gap-3">
                                        <h4 class="text-sm font-semibold text-slate-900 group-hover:text-emerald-600 transition leading-snug">{{ $task->title }}</h4>
                                        @if($task->priority === 'High')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200/60 uppercase">High</span>
                                        @elseif($task->priority === 'Medium')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60 uppercase">Medium</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 uppercase">Low</span>
                                        @endif
                                    </div>
                                    @if($task->description)
                                        <div class="mt-3 text-xs text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-100/80 leading-relaxed whitespace-pre-line">{{ $task->description }}</div>
                                    @endif
                                    <div class="flex justify-between items-center mt-5 pt-3 border-t border-slate-50">
                                        <span class="text-xs text-slate-400">Management Mandate</span>
                                        <form action="{{ route('tasks.status', $task->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="status" value="In Progress">
                                            <button type="submit" class="text-xs font-semibold text-emerald-600 hover:text-emerald-800 cursor-pointer hover:underline transition">Start Development &rarr;</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 px-4 border-2 border-dashed border-slate-200 rounded-xl bg-white/50">
                                    <h4 class="text-sm font-semibold text-slate-700">All Queue Lanes Cleared</h4>
                                    <p class="text-xs text-slate-400 mt-1">No pending tasks assigned.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- IN PROGRESS -->
                    <div class="bg-slate-100/70 p-5 rounded-2xl border border-slate-200/80 min-h-[400px] space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-600">Active Development (Processing)</h3>
                            </div>
                            <span class="bg-slate-200 text-slate-700 text-xs px-2.5 py-0.5 rounded-full font-bold">{{ $tasks->where('status', 'In Progress')->count() }}</span>
                        </div>
                        <div class="space-y-3">
                            @forelse($tasks->where('status', 'In Progress') as $task)
                                <div class="bg-white p-5 rounded-xl border-l-4 border-l-emerald-600 border border-slate-200 shadow-xs">
                                    <div class="flex items-start justify-between gap-3">
                                        <h4 class="text-sm font-semibold text-slate-900 leading-snug">{{ $task->title }}</h4>
                                        @if($task->priority === 'High')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200/60 uppercase">High</span>
                                        @elseif($task->priority === 'Medium')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60 uppercase">Medium</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 uppercase">Low</span>
                                        @endif
                                    </div>
                                    @if($task->description)
                                        <div class="mt-3 text-xs text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-100/80 leading-relaxed whitespace-pre-line">{{ $task->description }}</div>
                                    @endif
                                    <div class="flex justify-between items-center mt-5 pt-3 border-t border-slate-50">
                                        <span class="text-xs text-emerald-600 font-semibold flex items-center gap-1.5 animate-pulse">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Compilation Active
                                        </span>
                                        <form action="{{ route('tasks.status', $task->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="status" value="Completed">
                                            <button type="submit" class="text-xs font-semibold text-emerald-600 hover:text-emerald-800 cursor-pointer hover:underline transition">Mark Completed &#10003;</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-16 px-4 border-2 border-dashed border-slate-200 rounded-xl bg-white/50">
                                    <h4 class="text-sm font-semibold text-slate-700">Pipeline Idle</h4>
                                    <p class="text-xs text-slate-400 mt-1">Click 'Start Development' to move a task here.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div><!-- /panel-daily -->

            <!-- ===== POMODORO PANEL ===== -->
            <div id="panel-pomodoro" class="panel">
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-xs max-w-xl mx-auto">
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">&#9201; Pomodoro Timer</h2>
                    <p class="text-sm text-slate-500 mb-6">Stay focused with 25-minute work intervals.</p>

                    <!-- Timer ring -->
                    <div class="flex justify-center mb-6">
                        <div class="relative w-44 h-44">
                            <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="45" stroke="#e2e8f0" stroke-width="8" fill="none"/>
                                <circle id="timerRing" cx="50" cy="50" r="45" stroke="#10b981" stroke-width="8" fill="none"
                                    stroke-dasharray="282.74" stroke-dashoffset="0" stroke-linecap="round"
                                    style="transition: stroke-dashoffset 1s linear;"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span id="timerDisplay" class="text-4xl font-mono font-bold text-slate-800">25:00</span>
                                <span id="timerLabel" class="text-xs text-slate-400 font-medium mt-1">Focus</span>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <div class="flex justify-center gap-3 mb-8">
                        <button id="pomodoroStart" onclick="pomodoroStart()" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition">&#9654; Start</button>
                        <button id="pomodoroPause" onclick="pomodoroPause()" disabled class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-lg transition disabled:opacity-40">&#10074;&#10074; Pause</button>
                        <button onclick="pomodoroReset()" class="px-5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-sm font-semibold rounded-lg transition">&#8635; Reset</button>
                    </div>

                    <!-- Private Notes -->
                    <div class="border-t border-slate-100 pt-6">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <h3 class="text-sm font-bold text-slate-700">Private Notes <span class="text-xs font-normal text-slate-400">(stored on this device only)</span></h3>
                        </div>
                        <textarea id="privateNoteBox" rows="5"
                            class="w-full text-sm border border-slate-200 rounded-lg p-3 text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-400 resize-y"
                            placeholder="Jot down thoughts for this session..."></textarea>
                        <div class="flex items-center gap-2 mt-2">
                            <button onclick="savePrivateNote()" class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg transition">Save Note</button>
                            <span id="noteSavedMsg" class="text-xs text-emerald-600 hidden">&#10003; Saved!</span>
                        </div>
                    </div>
                </div>
            </div><!-- /panel-pomodoro -->

            <!-- ===== PRIVATE NOTES PANEL ===== -->
            <div id="panel-notes" class="panel">
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-xs max-w-xl mx-auto">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-slate-900">Private Notes</h2>
                    </div>
                    <p class="text-sm text-slate-500 mb-6">Your notes are encrypted locally and never sent to the server.</p>
                    <textarea id="standAloneNoteBox" rows="12"
                        class="w-full text-sm border border-slate-200 rounded-lg p-4 text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-400 resize-y"
                        placeholder="Write anything here — ideas, reminders, to-dos..."></textarea>
                    <div class="flex items-center gap-3 mt-3">
                        <button onclick="saveStandaloneNote()" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition">Save Notes</button>
                        <button onclick="clearStandaloneNote()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold rounded-lg transition">Clear</button>
                        <span id="standaloneNoteSavedMsg" class="text-xs text-emerald-600 hidden">&#10003; Saved!</span>
                    </div>
                </div>
            </div><!-- /panel-notes -->

            <!-- ===== ADMIN NOTES PANEL ===== -->
            <div id="panel-adminnotes" class="panel">
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-xs max-w-xl mx-auto">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-slate-900">Admin Notes</h2>
                        <span id="adminNotesFetchStatus" class="ml-auto text-xs text-slate-400"></span>
                    </div>
                    <p class="text-sm text-slate-500 mb-4">Official broadcast from the admin team. Updates live from the server.</p>

                    <!-- Admin notes display area (fetched from DB via server route) -->
                    <div id="adminNotesDisplay" class="text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-lg p-5 min-h-[200px] whitespace-pre-line leading-relaxed">
                        <span class="text-slate-400 italic animate-pulse">Loading admin notes...</span>
                    </div>

                    <p class="text-xs text-slate-400 mt-3 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Notes are broadcast by the administrator and stored on the server.
                    </p>
                </div>
            </div><!-- /panel-adminnotes -->

        </div><!-- /main content -->
    </main>

    <script>
        // ==================== PANEL SWITCHING ====================
        function showPanel(e, panelId) {
            if (e) e.preventDefault();
            // Hide all panels
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            // Remove active nav style
            document.querySelectorAll('.nav-link').forEach(n => n.classList.remove('active-nav'));
            // Show target panel
            document.getElementById(panelId).classList.add('active');
            // Highlight nav item
            const navId = 'nav-' + panelId.replace('panel-','');
            const navEl = document.getElementById(navId);
            if (navEl) navEl.classList.add('active-nav');
            // Load admin notes when panel shown
            if (panelId === 'panel-adminnotes') loadAdminNotes();
            // Sync private notes when panel shown
            if (panelId === 'panel-notes') loadStandaloneNote();
        }

        // Show daily board by default
        document.getElementById('nav-daily').classList.add('active-nav');

        // ==================== POMODORO TIMER ====================
        const WORK_DURATION = 25 * 60;
        let secondsLeft = WORK_DURATION;
        let timerId = null;

        function updateTimerDisplay() {
            const mins = String(Math.floor(secondsLeft / 60)).padStart(2, '0');
            const secs = String(secondsLeft % 60).padStart(2, '0');
            document.getElementById('timerDisplay').textContent = mins + ':' + secs;
            // Update SVG ring: circumference = 2*pi*45 = 282.74
            const pct = secondsLeft / WORK_DURATION;
            const offset = 282.74 * (1 - pct);
            document.getElementById('timerRing').style.strokeDashoffset = offset;
        }

        function pomodoroStart() {
            if (timerId) return;
            timerId = setInterval(function() {
                if (secondsLeft > 0) {
                    secondsLeft--;
                    updateTimerDisplay();
                } else {
                    clearInterval(timerId);
                    timerId = null;
                    document.getElementById('timerLabel').textContent = 'Done!';
                    alert('Pomodoro complete! Take a 5-minute break.');
                }
            }, 1000);
            document.getElementById('pomodoroStart').disabled = true;
            document.getElementById('pomodoroPause').disabled = false;
        }

        function pomodoroPause() {
            clearInterval(timerId);
            timerId = null;
            document.getElementById('pomodoroStart').disabled = false;
            document.getElementById('pomodoroPause').disabled = true;
        }

        function pomodoroReset() {
            clearInterval(timerId);
            timerId = null;
            secondsLeft = WORK_DURATION;
            document.getElementById('timerLabel').textContent = 'Focus';
            document.getElementById('pomodoroStart').disabled = false;
            document.getElementById('pomodoroPause').disabled = true;
            updateTimerDisplay();
        }

        // Load saved pomodoro note
        window.addEventListener('DOMContentLoaded', function() {
            const saved = localStorage.getItem('pomodoro_private_note');
            if (saved) document.getElementById('privateNoteBox').value = saved;
        });

        function savePrivateNote() {
            localStorage.setItem('pomodoro_private_note', document.getElementById('privateNoteBox').value);
            const msg = document.getElementById('noteSavedMsg');
            msg.classList.remove('hidden');
            setTimeout(() => msg.classList.add('hidden'), 2000);
        }

        // ==================== PRIVATE NOTES (standalone) ====================
        function loadStandaloneNote() {
            const saved = localStorage.getItem('private_notes_standalone');
            document.getElementById('standAloneNoteBox').value = saved || '';
        }

        function saveStandaloneNote() {
            localStorage.setItem('private_notes_standalone', document.getElementById('standAloneNoteBox').value);
            const msg = document.getElementById('standaloneNoteSavedMsg');
            msg.classList.remove('hidden');
            setTimeout(() => msg.classList.add('hidden'), 2000);
        }

        function clearStandaloneNote() {
            document.getElementById('standAloneNoteBox').value = '';
            localStorage.removeItem('private_notes_standalone');
        }

        // ==================== ADMIN NOTES (server fetch) ====================
        function loadAdminNotes() {
            const el = document.getElementById('adminNotesDisplay');
            const status = document.getElementById('adminNotesFetchStatus');
            fetch('{{ route("admin.notes.show") }}')
                .then(r => r.json())
                .then(data => {
                    if (data.content && data.content.trim() !== '') {
                        el.textContent = data.content;
                        if (status) status.textContent = 'Updated ' + (data.updated || '');
                    } else {
                        el.innerHTML = '<span class="text-slate-400 italic">No admin notes broadcast yet.</span>';
                        if (status) status.textContent = '';
                    }
                })
                .catch(() => {
                    el.innerHTML = '<span class="text-red-400 italic">Could not load admin notes.</span>';
                });
        }
    </script>
</body>
</html>