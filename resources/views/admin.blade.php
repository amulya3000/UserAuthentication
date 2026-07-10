<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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

            <!-- Profile Actions -->
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
                    <h3 class="text-sm font-semibold text-red-800">Deployment Error</h3>
                </div>
                <ul class="list-disc list-inside text-xs text-red-700 pl-8 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- SECTION 1: MANUAL WORKFLOW DIVISION PANEL -->
            <section class="lg:col-span-5 bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-md font-semibold text-slate-900">Task Allocation Engine</h2>
                    <p class="text-xs text-slate-500 mt-1">Deploy tasks along with specifications directly to assigned employee containers.</p>
                </div>

                <div class="p-6">
                    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Task Title</label>
                            <input type="text" id="title" name="title" required placeholder="Describe task objective..." class="w-full text-sm rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none">
                        </div>

                        <div>
                            <label for="user_id" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Assign To Employee</label>
                            <select id="user_id" name="user_id" required class="w-full text-sm rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none">
                                <option value="" disabled selected>Choose an employee...</option>
                                @forelse($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @empty
                                    <option value="" disabled>No active employees registered yet.</option>
                                @endforelse
                            </select>
                        </div>

                        <div>
                            <label for="priority" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Priority Classification</label>
                            <select id="priority" name="priority" required class="w-full text-sm rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none">
                                <option value="Low">Low Priority</option>
                                <option value="Medium" selected>Medium Priority</option>
                                <option value="High">High Priority</option>
                            </select>
                        </div>

                        <!-- Detailed Task Description Field -->
                        <div>
                            <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Task Requirements & Description</label>
                            <textarea id="description" name="description" required rows="4" placeholder="Detail the guidelines, key dependencies, and expected deliverables for the employee..." class="w-full text-sm rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none leading-relaxed"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-slate-950 hover:bg-slate-800 text-white font-medium text-sm py-3 rounded-lg shadow-sm transition flex items-center justify-center gap-2 cursor-pointer">
                            Deploy Task &rarr;
                        </button>
                    </form>
                </div>
            </section>

            <!-- SECTION 2: PROJECT SPECIFICATION PORTAL -->
            <section class="lg:col-span-7 bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-md font-semibold text-slate-900">Project Brief & Guidelines</h2>
                    <p class="text-xs text-slate-500 mt-1">Publish a comprehensive system walkthrough or roadmap (supports up to 2,000 words).</p>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.project.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="project_title" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Brief Title</label>
                            <input type="text" id="project_title" name="title" required value="{{ $project->title }}" class="w-full text-sm font-semibold rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none">
                        </div>

                        <div>
                            <label for="project_desc" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Project Explanation / Specifications</label>
                            <textarea id="project_desc" name="description" required rows="12" placeholder="Write up to 2,000 words explaining scope, architecture, design assets, and workflows..." class="w-full text-sm rounded-lg border border-slate-200 p-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition outline-none leading-relaxed" oninput="countWords()">{{ $project->description }}</textarea>
                            <div class="flex justify-between text-xs text-slate-400 mt-2">
                                <span>Markdown formatting can be added manually</span>
                                <span id="word_counter">0 / 2000 Words</span>
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-5 py-2.5 rounded-lg shadow-sm transition cursor-pointer">
                            Publish Project Brief
                        </button>
                    </form>
                </div>
            </section>

        </div>
    </main>

    <script>
        function countWords() {
            const text = document.getElementById('project_desc').value.trim();
            const words = text ? text.split(/\s+/).length : 0;
            const counter = document.getElementById('word_counter');
            counter.innerText = `${words} / 2000 Words`;
            if (words > 2000) {
                counter.classList.add('text-red-500', 'font-semibold');
            } else {
                counter.classList.remove('text-red-500', 'font-semibold');
            }
        }
        window.onload = countWords;
    </script>
</body>
</html>