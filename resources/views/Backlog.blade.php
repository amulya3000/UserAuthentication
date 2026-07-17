<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backlog - To-Do List App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans flex min-h-screen">

    <!-- Sidebar -->
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
                <a href="{{ route('backlog') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium bg-blue-50 text-blue-600">
                    📋 Backlog
                </a>
                <a href="{{ route('sprint') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                    🏃 Sprints
                </a>
                <a href="{{ route('scrum') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                    📊 Scrum Board
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-8">
        <div class="max-w-4xl mx-auto">
            
            <!-- Success Toast Notification -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <p class="text-xs text-slate-500 font-medium">Projects / Create To-Do List App</p>
                    <h1 class="text-2xl font-bold text-slate-900 mt-1">Backlog</h1>
                </div>
                <a href="{{ route('scrum') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-md shadow transition-all duration-200 flex items-center gap-2">
                    <span>➕ Create</span>
                </a>
            </div>

            <!-- Backlog Container -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 mb-6">
                <h2 class="text-sm font-semibold text-slate-500 mb-4 uppercase tracking-wider">Backlog ({{ $backlogs->count() }} issues)</h2>
                
                <div class="divide-y divide-slate-100">
                    @forelse($backlogs as $item)
                        <div class="flex items-center justify-between py-3 hover:bg-slate-50 px-2 rounded transition-colors group">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-mono bg-slate-100 px-2 py-1 rounded text-slate-600 font-semibold">{{ $item->task_id }}</span>
                                <span class="text-sm text-slate-700 font-medium">{{ $item->title }}</span>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <!-- Dynamic Type Badges -->
                                <span class="text-xs px-2.5 py-0.5 rounded-full font-medium 
                                    {{ $item->type == 'Story' ? 'bg-blue-50 text-blue-600' : '' }}
                                    {{ $item->type == 'Task' ? 'bg-purple-50 text-purple-600' : '' }}
                                    {{ $item->type == 'Bug' ? 'bg-red-50 text-red-600' : '' }}">
                                    {{ $item->type }}
                                </span>

                                <!-- Actions: Modify & Remove -->
                                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <!-- Edit Button -->
                                    <button onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ $item->type }}')" class="text-xs text-slate-500 hover:text-blue-600 font-semibold">
                                        Modify
                                    </button>
                                    
                                    <!-- Delete Form -->
                                    <form action="{{ route('backlog.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this task permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-semibold">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-sm text-slate-400 py-6">No issues in your backlog. Use the field below to add one!</p>
                    @endforelse
                </div>
            </div>

            <!-- Dynamic Store Action Form -->
            <form action="{{ route('backlog.store') }}" method="POST" class="flex gap-2 bg-white p-3 rounded-lg border border-slate-200 shadow-sm">
                @csrf
                <input 
                    type="text" 
                    name="title"
                    required
                    placeholder="What needs to be done?" 
                    class="flex-1 px-4 py-2 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-slate-50"
                />
                <select name="type" class="px-3 py-2 border border-slate-200 rounded-md text-sm bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Task">Task</option>
                    <option value="Story">Story</option>
                    <option value="Bug">Bug</option>
                </select>
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-medium px-5 py-2 rounded-md text-sm transition-colors">
                    Add to Backlog
                </button>
            </form>

        </div>
    </main>

    <!-- HTML Edit Overlay Modal (Hidden By Default) -->
    <div id="editModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 border border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Modify Task</h3>
            
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Task Title</label>
                    <input type="text" id="editTitle" name="title" required class="w-full px-3 py-2 border border-slate-200 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Issue Type</label>
                    <select id="editType" name="type" class="w-full px-3 py-2 border border-slate-200 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
                        <option value="Task">Task</option>
                        <option value="Story">Story</option>
                        <option value="Bug">Bug</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-md">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Handling for Modifying Entries -->
    <script>
        function openEditModal(id, title, type) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            
            // Set input values dynamically
            document.getElementById('editTitle').value = title;
            document.getElementById('editType').value = type;
            
            // Set dynamic action route direction URL 
            form.action = `/backlog/${id}`;
            
            // Unhide modal
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>