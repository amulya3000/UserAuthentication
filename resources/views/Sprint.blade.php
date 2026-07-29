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
                
                <form action="{{ route('sprints.store') }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <input type="text" name="name" placeholder="Sprint Name" required class="px-3 py-1.5 border border-slate-200 rounded-md text-sm">
                    <button type="submit" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-md text-sm transition-colors flex items-center gap-2">
                        <span>➕ Start Sprint</span>
                    </button>
                </form>
            </div>

            @forelse($sprints as $sprint)
            <div class="bg-white rounded-lg border {{ $sprint->is_active ? 'border-blue-400' : 'border-slate-200' }} shadow-sm p-6 mb-8">
                <form action="{{ route('sprints.update', $sprint->id) }}" method="POST" class="mb-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <h2 class="text-lg font-bold text-slate-900">{{ $sprint->name }}</h2>
                            @if($sprint->is_active)
                                <span class="bg-blue-100 text-blue-700 text-xs px-2 py-0.5 rounded-full font-semibold">Active Sprint</span>
                            @endif
                            <label class="flex items-center gap-1 text-sm text-slate-600 ml-4 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ $sprint->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                                Set Active
                            </label>
                        </div>
                        
                        <div class="flex gap-2">
                            <input type="date" name="start_date" value="{{ $sprint->start_date }}" class="text-sm px-2 py-1 border border-slate-200 rounded-md">
                            <span class="text-slate-400">-</span>
                            <input type="date" name="end_date" value="{{ $sprint->end_date }}" class="text-sm px-2 py-1 border border-slate-200 rounded-md">
                        </div>
                    </div>

                    <div class="mb-4">
                        <textarea name="notes" placeholder="Add sprint notes here..." class="w-full text-sm px-3 py-2 border border-slate-200 rounded-md bg-slate-50 focus:bg-white" rows="2">{{ $sprint->notes }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-md font-medium transition-colors">
                            Save Sprint Details
                        </button>
                    </div>
                </form>
                
                <h3 class="text-xs font-bold text-slate-500 uppercase mb-2">Backlog ({{ $sprint->backlogs->count() }} issues)</h3>
                
                <div class="divide-y divide-slate-100 border border-slate-100 rounded-md mb-4">
                    @forelse($sprint->backlogs as $item)
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

                <form action="{{ route('sprint.issue.store', $sprint->id) }}" method="POST" class="mt-4 flex gap-2">
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
            @empty
            <div class="text-center py-12">
                <p class="text-slate-500 mb-4">No sprints created yet.</p>
            </div>
            @endforelse

        </div>
    </main>

</body>
</html>
