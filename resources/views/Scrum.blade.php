<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrum Board - To-Do List App</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 p-4 hidden md:flex flex-col gap-6">
        <!-- Back to Dashboard -->
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
                <a href="{{ route('sprint') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                    🏃 Sprints
                </a>
                <a href="{{ route('scrum') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium bg-blue-50 text-blue-600">
                    📊 Scrum Board
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-8">
        <div class="max-w-5xl mx-auto">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <p class="text-xs text-slate-500 font-medium">Projects / Create To-Do List App</p>
                    <h1 class="text-2xl font-bold text-slate-900 mt-1">Scrum Board</h1>
                </div>
                
                <!-- Back Button -->
                <a href="{{ route('backlog') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-md text-sm transition-colors flex items-center gap-2">
                    <span>← Back to Backlog</span>
                </a>
            </div>

            <!-- Board Columns Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Column 1: TO DO -->
                <div class="bg-slate-100 p-4 rounded-lg min-h-[450px]">
                    <h3 class="text-xs font-bold text-slate-500 uppercase mb-4 flex items-center justify-between">
                        <span>To Do</span>
                        <span class="bg-slate-200 text-slate-600 px-2 py-0.5 rounded-full text-[10px]">3</span>
                    </h3>
                    
                    <div class="flex flex-col gap-3">
                        <!-- Card 1 -->
                        <div class="bg-white p-4 rounded-md shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                            <p class="text-sm font-medium text-slate-800 mb-2">User Account Management</p>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-mono text-slate-400 font-semibold">CREAT-1</span>
                                <span class="text-[10px] bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded">Story</span>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-white p-4 rounded-md shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                            <p class="text-sm font-medium text-slate-800 mb-2">Design database schema</p>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-mono text-slate-400 font-semibold">CREAT-2</span>
                                <span class="text-[10px] bg-purple-50 text-purple-600 px-1.5 py-0.5 rounded">Task</span>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-white p-4 rounded-md shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                            <p class="text-sm font-medium text-slate-800 mb-2">Fix login button layout issues</p>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-mono text-slate-400 font-semibold">CREAT-3</span>
                                <span class="text-[10px] bg-red-50 text-red-600 px-1.5 py-0.5 rounded">Bug</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2: IN PROGRESS -->
                <div class="bg-slate-100 p-4 rounded-lg min-h-[450px]">
                    <h3 class="text-xs font-bold text-slate-500 uppercase mb-4 flex items-center justify-between">
                        <span>In Progress</span>
                        <span class="bg-slate-200 text-slate-600 px-2 py-0.5 rounded-full text-[10px]">0</span>
                    </h3>
                    
                    <div class="flex flex-col gap-2 justify-center items-center h-48 border-2 border-dashed border-slate-300 rounded-md">
                        <span class="text-xs text-slate-400 font-medium">Drag tasks here</span>
                    </div>
                </div>

                <!-- Column 3: DONE -->
                <div class="bg-slate-100 p-4 rounded-lg min-h-[450px]">
                    <h3 class="text-xs font-bold text-slate-500 uppercase mb-4 flex items-center justify-between">
                        <span>Done</span>
                        <span class="bg-slate-200 text-slate-600 px-2 py-0.5 rounded-full text-[10px]">0</span>
                    </h3>
                    
                    <div class="flex flex-col gap-2 justify-center items-center h-48 border-2 border-dashed border-slate-300 rounded-md">
                        <span class="text-xs text-slate-400 font-medium">No tasks completed yet</span>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>