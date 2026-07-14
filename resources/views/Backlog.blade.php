<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backlog - To-Do List App</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 p-4 hidden md:flex flex-col gap-6">
        <div>
            <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Planning</h2>
            <nav class="mt-2 flex flex-col gap-1">
                <a href="{{ route('backlog') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium bg-blue-50 text-blue-600">
                    📋 Backlog
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
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <p class="text-xs text-slate-500 font-medium">Projects / Create To-Do List App</p>
                    <h1 class="text-2xl font-bold text-slate-900 mt-1">Backlog</h1>
                </div>
                
                <!-- Target "Create" Button to navigate to Scrum page -->
                <a href="{{ route('scrum') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-md shadow transition-all duration-200 flex items-center gap-2">
                    <span>➕ Create</span>
                </a>
            </div>

            <!-- Backlog Container -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 mb-6">
                <h2 class="text-sm font-semibold text-slate-500 mb-4 uppercase tracking-wider">Backlog (3 issues)</h2>
                
                <div class="divide-y divide-slate-100">
                    <!-- Issue 1 -->
                    <div class="flex items-center justify-between py-3 hover:bg-slate-50 px-2 rounded transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-mono bg-slate-100 px-2 py-1 rounded text-slate-600 font-semibold">CREAT-1</span>
                            <span class="text-sm text-slate-700 font-medium">User Account Management</span>
                        </div>
                        <span class="text-xs bg-blue-50 text-blue-600 px-2.5 py-0.5 rounded-full font-medium">Story</span>
                    </div>

                    <!-- Issue 2 -->
                    <div class="flex items-center justify-between py-3 hover:bg-slate-50 px-2 rounded transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-mono bg-slate-100 px-2 py-1 rounded text-slate-600 font-semibold">CREAT-2</span>
                            <span class="text-sm text-slate-700 font-medium">Design database schema</span>
                        </div>
                        <span class="text-xs bg-purple-50 text-purple-600 px-2.5 py-0.5 rounded-full font-medium">Task</span>
                    </div>

                    <!-- Issue 3 -->
                    <div class="flex items-center justify-between py-3 hover:bg-slate-50 px-2 rounded transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-mono bg-slate-100 px-2 py-1 rounded text-slate-600 font-semibold">CREAT-3</span>
                            <span class="text-sm text-slate-700 font-medium">Fix login button layout issues</span>
                        </div>
                        <span class="text-xs bg-red-50 text-red-600 px-2.5 py-0.5 rounded-full font-medium">Bug</span>
                    </div>
                </div>
            </div>

            <!-- Fake Quick Add Input -->
            <div class="flex gap-2">
                <input 
                    type="text" 
                    placeholder="What needs to be done?" 
                    class="flex-1 px-4 py-2 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white"
                />
                <button type="button" class="bg-slate-800 hover:bg-slate-900 text-white font-medium px-4 py-2 rounded-md text-sm transition-colors">
                    Add to Backlog
                </button>
            </div>

        </div>
    </main>

</body>
</html>