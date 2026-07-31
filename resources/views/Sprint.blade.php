<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprints - To-Do List App</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .progress-bar-animated {
            transition: width 1s ease-in-out;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex min-h-screen relative overflow-x-hidden font-sans">

    <!-- Decorative Gradients -->
    <div class="fixed top-[-20%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-blue-300/20 blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-[-20%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-purple-300/20 blur-[120px] pointer-events-none"></div>

    <!-- Sidebar -->
    <aside class="w-64 glass border-r border-slate-200/50 p-5 hidden md:flex flex-col gap-8 z-10 sticky top-0 h-screen">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-semibold shadow-lg shadow-slate-900/20 hover:bg-slate-800 transition-all hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>

        <div>
            <h2 class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-3 ml-2">Planning</h2>
            <nav class="flex flex-col gap-1.5">
                <a href="{{ route('backlog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-white/60 hover:shadow-sm transition-all">
                    <span class="text-lg">📋</span> Backlog
                </a>
                <a href="{{ route('sprint') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium bg-blue-50/80 text-blue-700 shadow-sm border border-blue-100/50">
                    <span class="text-lg">🏃</span> Sprints
                </a>
                <a href="{{ route('scrum') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-white/60 hover:shadow-sm transition-all">
                    <span class="text-lg">📊</span> Scrum Board
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 md:p-12 z-10">
        <div class="max-w-5xl mx-auto">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-700 rounded-xl text-sm font-medium flex items-center gap-3 backdrop-blur-sm shadow-sm animate-fade-in-down">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif
           
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
                <div>
                    <p class="text-xs text-blue-600/80 font-semibold tracking-wide uppercase mb-1">Projects / To-Do App</p>
                    <h1 class="text-4xl font-bold text-slate-900 tracking-tight">Sprints Timeline</h1>
                    <p class="text-sm text-slate-500 mt-2 font-medium">Manage and track your active sprints</p>
                </div>
                
                <form action="{{ route('sprints.store') }}" method="POST" class="flex items-center gap-2 bg-white/50 p-1.5 rounded-xl border border-slate-200/60 shadow-sm backdrop-blur-md">
                    @csrf
                    <input type="text" name="name" placeholder="New Sprint Name" required class="px-4 py-2 bg-transparent border-none focus:ring-0 text-sm font-medium w-48 placeholder:text-slate-400 outline-none">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg text-sm transition-all shadow-md shadow-blue-600/20 flex items-center gap-2 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Start</span>
                    </button>
                </form>
            </div>

            <div class="space-y-8">
                @forelse($sprints as $sprint)
                <div class="glass rounded-2xl border {{ $sprint->is_active ? 'border-blue-400/50 shadow-xl shadow-blue-900/5' : 'border-slate-200/60 shadow-lg shadow-slate-200/40' }} p-6 md:p-8 transition-all hover:shadow-xl">
                    <form action="{{ route('sprints.update', $sprint->id) }}" method="POST" class="mb-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                            <div class="flex items-center gap-4 flex-wrap">
                                <h2 class="text-2xl font-bold text-slate-800">{{ $sprint->name }}</h2>
                                
                                @if($sprint->status == 'Completed')
                                    <span class="bg-green-100 text-green-700 text-[11px] px-3 py-1 rounded-full font-bold tracking-wide uppercase border border-green-200 flex items-center gap-1 shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Completed
                                    </span>
                                @elseif($sprint->is_active)
                                    <span class="bg-blue-600 text-white text-[11px] px-3 py-1 rounded-full font-bold tracking-wide uppercase shadow-sm shadow-blue-600/30 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                        Active Sprint
                                    </span>
                                @else
                                    <span class="bg-slate-200/70 text-slate-600 text-[11px] px-3 py-1 rounded-full font-bold tracking-wide uppercase border border-slate-300/50">
                                        {{ $sprint->status }}
                                    </span>
                                @endif

                                @if($sprint->status != 'Completed')
                                    <label class="flex items-center gap-2 text-sm font-medium text-slate-500 ml-2 cursor-pointer hover:text-slate-800 transition-colors group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox" name="is_active" value="1" {{ $sprint->is_active ? 'checked' : '' }} onchange="this.form.submit()" class="sr-only peer">
                                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500 shadow-inner"></div>
                                        </div>
                                        Set Active
                                    </label>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-2 bg-white/50 p-1 rounded-lg border border-slate-200/60 shadow-sm">
                                <input type="date" name="start_date" value="{{ $sprint->start_date }}" class="text-sm px-3 py-1.5 bg-transparent border-none focus:ring-0 text-slate-600 font-medium w-[130px] rounded-md hover:bg-white transition-colors">
                                <span class="text-slate-300 font-light">→</span>
                                <input type="date" name="end_date" value="{{ $sprint->end_date }}" class="text-sm px-3 py-1.5 bg-transparent border-none focus:ring-0 text-slate-600 font-medium w-[130px] rounded-md hover:bg-white transition-colors">
                            </div>
                        </div>

                        <div class="mb-4">
                            <textarea name="notes" placeholder="Add sprint goals, outcomes, or notes here..." class="w-full text-sm px-4 py-3 border border-slate-200/80 rounded-xl bg-white/50 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-300 transition-all shadow-sm placeholder:text-slate-400" rows="2">{{ $sprint->notes }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="text-xs bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg font-medium transition-all shadow-md shadow-slate-800/10 hover:-translate-y-0.5">
                                Save Sprint Details
                            </button>
                        </div>
                    </form>
                    
                    <!-- Progress & Metrics section -->
                    @php 
                        $counts = $sprint->task_counts; 
                        $pct = $sprint->completion_percentage;
                        $blocked = $counts['on_hold'] + $counts['cancelled'];
                    @endphp
                    
                    <div class="bg-white/60 rounded-xl p-5 border border-slate-100 shadow-sm mb-6">
                        <div class="flex justify-between items-end mb-2">
                            <h3 class="text-sm font-bold text-slate-700">Sprint Progress</h3>
                            <span class="text-xl font-black {{ $pct == 100 ? 'text-green-600' : 'text-blue-600' }}">{{ $pct }}%</span>
                        </div>
                        <div class="w-full bg-slate-200/80 rounded-full h-3 mb-4 overflow-hidden shadow-inner">
                            <div class="bg-gradient-to-r {{ $pct == 100 ? 'from-green-400 to-green-500' : 'from-blue-500 to-purple-500' }} h-3 rounded-full progress-bar-animated relative" style="width: {{ $pct }}%">
                                <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mt-4">
                            <div class="bg-slate-50 border border-slate-100 rounded-lg p-3 text-center">
                                <span class="block text-2xl font-bold text-slate-700">{{ $counts['total'] }}</span>
                                <span class="block text-[10px] uppercase font-semibold text-slate-400 tracking-wider">Total</span>
                            </div>
                            <div class="bg-white border border-slate-100 rounded-lg p-3 text-center shadow-sm">
                                <span class="block text-2xl font-bold text-blue-600">{{ $counts['in_progress'] }}</span>
                                <span class="block text-[10px] uppercase font-semibold text-slate-400 tracking-wider">Active</span>
                            </div>
                            <div class="bg-white border border-slate-100 rounded-lg p-3 text-center shadow-sm">
                                <span class="block text-2xl font-bold text-green-600">{{ $counts['done'] }}</span>
                                <span class="block text-[10px] uppercase font-semibold text-slate-400 tracking-wider">Done</span>
                            </div>
                            
                            <!-- Blocked metric highlights -->
                            <div class="bg-orange-50/50 border {{ $counts['on_hold'] > 0 ? 'border-orange-300 shadow-sm shadow-orange-500/10' : 'border-orange-100' }} rounded-lg p-3 text-center transition-all">
                                <span class="block text-2xl font-bold text-orange-600">{{ $counts['on_hold'] }}</span>
                                <span class="block text-[10px] uppercase font-semibold text-orange-400 tracking-wider">On Hold</span>
                            </div>
                            <div class="bg-red-50/50 border {{ $counts['cancelled'] > 0 ? 'border-red-300 shadow-sm shadow-red-500/10' : 'border-red-100' }} rounded-lg p-3 text-center transition-all">
                                <span class="block text-2xl font-bold text-red-600">{{ $counts['cancelled'] }}</span>
                                <span class="block text-[10px] uppercase font-semibold text-red-400 tracking-wider">Cancelled</span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex justify-between items-center mb-4 px-2">
                        <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            Backlog Items
                            <span class="bg-slate-200 text-slate-600 text-xs px-2 py-0.5 rounded-md">{{ $counts['total'] }}</span>
                        </h3>
                        @if($blocked > 0)
                        <span class="text-xs font-semibold text-red-500 bg-red-50 px-2 py-1 rounded-md border border-red-100 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ $blocked }} Blocked Task(s)
                        </span>
                        @endif
                    </div>
                    
                    <div class="bg-white/80 rounded-xl border border-slate-200 overflow-hidden shadow-sm mb-5">
                        <div class="divide-y divide-slate-100">
                            @forelse($sprint->backlogs as $item)
                                <div class="flex items-center justify-between p-3 hover:bg-slate-50/80 transition-colors group">
                                    <div class="flex items-center gap-4">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-mono text-slate-400 font-semibold mb-0.5">{{ $item->task_id }}</span>
                                            <span class="text-sm text-slate-800 font-medium">{{ $item->title }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-[11px] px-2.5 py-1 rounded-md font-semibold border 
                                            {{ $item->type == 'Story' ? 'bg-blue-50 border-blue-100 text-blue-600' : '' }}
                                            {{ $item->type == 'Task' ? 'bg-purple-50 border-purple-100 text-purple-600' : '' }}
                                            {{ $item->type == 'Bug' ? 'bg-rose-50 border-rose-100 text-rose-600' : '' }}">
                                            {{ $item->type }}
                                        </span>
                                        
                                        <span class="text-[11px] px-2.5 py-1 rounded-md font-semibold border
                                            {{ $item->status == 'Done' ? 'bg-green-50 border-green-100 text-green-600' : '' }}
                                            {{ $item->status == 'In Progress' ? 'bg-blue-50 border-blue-100 text-blue-600' : '' }}
                                            {{ $item->status == 'To Do' ? 'bg-slate-100 border-slate-200 text-slate-600' : '' }}
                                            {{ $item->status == 'On Hold' ? 'bg-orange-50 border-orange-100 text-orange-600' : '' }}
                                            {{ $item->status == 'Cancelled' ? 'bg-red-50 border-red-100 text-red-600' : '' }}">
                                            {{ $item->status }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                                        <span class="text-xl">👻</span>
                                    </div>
                                    <p class="text-sm text-slate-500 font-medium">No issues in this sprint yet.</p>
                                    <p class="text-xs text-slate-400 mt-1">Add tasks below to start planning.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @if($sprint->status != 'Completed')
                    <form action="{{ route('sprint.issue.store', $sprint->id) }}" method="POST" class="flex gap-3 bg-slate-50/80 p-2 rounded-xl border border-slate-200/60">
                        @csrf
                        <input 
                            type="text" 
                            name="title"
                            required
                            placeholder="What needs to be done?" 
                            class="flex-1 px-4 py-2 border-none bg-white rounded-lg focus:ring-2 focus:ring-blue-100 shadow-sm text-sm"
                        />
                        <select name="type" class="px-3 py-2 border-none bg-white rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-blue-100 font-medium text-slate-600 cursor-pointer">
                            <option value="Task">Task 📝</option>
                            <option value="Story">Story 📚</option>
                            <option value="Bug">Bug 🐛</option>
                        </select>
                        <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-medium px-5 py-2 rounded-lg text-sm transition-all shadow-md hover:-translate-y-0.5">
                            Add Issue
                        </button>
                    </form>
                    @endif
                </div>
                @empty
                <div class="glass text-center py-24 rounded-3xl border border-slate-200/50 shadow-sm">
                    <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-100">
                        <span class="text-3xl">🏁</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">No Sprints Yet</h3>
                    <p class="text-slate-500 mb-6 max-w-sm mx-auto font-medium">Start planning your work by creating your first sprint using the form above.</p>
                </div>
                @endforelse
            </div>

        </div>
    </main>

</body>
</html>
