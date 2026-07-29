<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprints - To-Do List App</title>
   
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans flex min-h-screen">

  
    <aside class="w-64 bg-white border-r border-slate-200 p-4 hidden md:flex flex-col gap-6">
      
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-lg text-sm font-semibold shadow-sm hover:bg-slate-800 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>

        <div>
            <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Planning</h2>
            <nav class="mt-2 flex flex-col gap-1">
                <a href="{{ route('backlog') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                    📋 Backlog
                </a>
                <a href="{{ route('sprint') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium bg-blue-50 text-blue-600">
                    🏃 Sprints
                </a>
                <a href="{{ route('scrum') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                    📊 Scrum Board
                </a>
            </nav>
        </div>
    </aside>

    
    <main class="flex-1 p-8">
        <div class="max-w-4xl mx-auto">
            
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif
           
            <div class="flex justify-between items-center mb-6">
                <div>
                    <p class="text-xs text-slate-500 font-medium">Projects / Create To-Do List App</p>
                    <h1 class="text-2xl font-bold text-slate-900 mt-1">Sprints Timeline</h1>
                </div>
                
                <button class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-md text-sm transition-colors flex items-center gap-2">
                    <span>➕ Start Sprint</span>
                </button>
            </div>

          
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-bold text-slate-900">Sprint 1</h2>
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-0.5 rounded-full font-semibold">Active Sprint</span>
                    </div>
                    
                    <div class="text-sm text-slate-500 font-medium bg-slate-100 px-3 py-1 rounded-md border border-slate-200 flex items-center gap-2">
                        <span>🗓️</span> Jul 14 - Jul 28
                    </div>
                </div>
                
                <div class="divide-y divide-slate-100 border border-slate-100 rounded-md mb-4">
                    @forelse($sprintBacklogs as $item)
                        <div class="flex items-center justify-between py-3 hover:bg-slate-50 px-3 transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-mono bg-slate-100 px-2 py-1 rounded text-slate-600 font-semibold">{{ $item->task_id }}</span>
                                <span class="text-sm text-slate-700 font-medium">{{ $item->title }}</span>
                            </div>
                            <span class="text-xs px-2.5 py-0.5 rounded-full font-medium 
                                {{ $item->type == 'Story' ? 'bg-blue-50 text-blue-600' : '' }}
                                {{ $item->type == 'Task' ? 'bg-purple-50 text-purple-600' : '' }}
                                {{ $item->type == 'Bug' ? 'bg-red-50 text-red-600' : '' }}">
                                {{ $item->type }}
                            </span>
                        </div>
                    @empty
                        <p class="text-center text-sm text-slate-400 py-4">No issues in this sprint yet.</p>
                    @endforelse
                </div>

                <form action="{{ route('sprint.store') }}" method="POST" class="mt-4 flex gap-2">
                    @csrf
                    <input 
                        type="text" 
                        name="title"
                        required
                        placeholder="Add an issue to this sprint..." 
                        class="flex-1 px-3 py-1.5 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-300 text-sm bg-white"
                    />
                    <select name="type" class="px-3 py-1.5 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-300">
                        <option value="Task">Task</option>
                        <option value="Story">Story</option>
                        <option value="Bug">Bug</option>
                    </select>
                    <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200 font-medium px-3 py-1.5 rounded-md text-sm transition-colors">
                        Add
                    </button>
                </form>
            </div>

            <!-- Sprint 2 (Planned) -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 mb-8 border-l-4 border-l-slate-300">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-bold text-slate-800">Sprint 2</h2>
                        <span class="bg-slate-100 text-slate-600 text-xs px-2 py-0.5 rounded-full font-semibold">Planned</span>
                    </div>
                    <!-- Month and Day Timeline Format -->
                    <div class="text-sm text-slate-500 font-medium bg-slate-50 px-3 py-1 rounded-md border border-slate-200 flex items-center gap-2">
                        <span>🗓️</span> Jul 29 - Aug 12
                    </div>
                </div>
                
                <div class="divide-y divide-slate-100 border border-slate-100 rounded-md bg-slate-50/50">
                    <!-- Issue 3 -->
                    <div class="flex items-center justify-between py-3 hover:bg-white px-3 transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-mono bg-slate-100 px-2 py-1 rounded text-slate-600 font-semibold">CREAT-3</span>
                            <span class="text-sm text-slate-700 font-medium">Fix login button layout issues</span>
                        </div>
                        <span class="text-xs bg-red-50 text-red-600 px-2.5 py-0.5 rounded-full font-medium">Bug</span>
                    </div>
                </div>
                
                <div class="mt-4 flex gap-2">
                    <p class="text-xs text-slate-400">Add form moved to active sprint.</p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
