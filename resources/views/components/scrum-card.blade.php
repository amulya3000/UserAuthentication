<div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out cursor-pointer relative group">
    <p class="text-sm font-medium text-slate-800 mb-3">{{ $item->title }}</p>
    <div class="flex justify-between items-center">
        <span class="text-[10px] font-mono text-slate-400 font-semibold bg-slate-100 px-1.5 py-0.5 rounded">{{ $item->task_id }}</span>
        <span class="text-[10px] px-2 py-0.5 rounded-full font-medium shadow-sm
            {{ $item->type == 'Story' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : '' }}
            {{ $item->type == 'Task' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : '' }}
            {{ $item->type == 'Bug' ? 'bg-red-50 text-red-600 border border-red-100' : '' }}">
            {{ $item->type }}
        </span>
    </div>
    
    <!-- Hover actions to change status -->
    <div class="absolute inset-0 bg-white/90 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-xl flex flex-col justify-center items-center gap-1 p-3">
        <form action="{{ route('scrum.status', $item->id) }}" method="POST" class="w-full flex gap-1 h-full items-center justify-center">
            @csrf
            <select name="status" class="w-3/4 text-xs p-2 font-medium text-slate-700 bg-white border border-emerald-200 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all cursor-pointer" onchange="this.form.submit()">
                <option value="To Do" {{ $item->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                <option value="In Progress" {{ $item->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="On Hold" {{ $item->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                <option value="Cancelled" {{ $item->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="Done" {{ $item->status == 'Done' ? 'selected' : '' }}>Done</option>
            </select>
        </form>
    </div>
</div>
