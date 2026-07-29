<div class="bg-white p-3 rounded-md shadow-sm border border-slate-200 hover:shadow-md transition-all cursor-pointer relative group">
    <p class="text-sm font-medium text-slate-800 mb-2">{{ $item->title }}</p>
    <div class="flex justify-between items-center">
        <span class="text-[10px] font-mono text-slate-400 font-semibold">{{ $item->task_id }}</span>
        <span class="text-[10px] px-1.5 py-0.5 rounded
            {{ $item->type == 'Story' ? 'bg-blue-50 text-blue-600' : '' }}
            {{ $item->type == 'Task' ? 'bg-purple-50 text-purple-600' : '' }}
            {{ $item->type == 'Bug' ? 'bg-red-50 text-red-600' : '' }}">
            {{ $item->type }}
        </span>
    </div>
    
    <!-- Hover actions to change status -->
    <div class="absolute inset-0 bg-white/95 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity rounded-md flex flex-col justify-center items-center gap-1 p-2">
        <form action="{{ route('scrum.status', $item->id) }}" method="POST" class="w-full flex gap-1">
            @csrf
            <select name="status" class="w-full text-xs p-1 border border-slate-200 rounded" onchange="this.form.submit()">
                <option value="To Do" {{ $item->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                <option value="In Progress" {{ $item->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="On Hold" {{ $item->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                <option value="Cancelled" {{ $item->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="Done" {{ $item->status == 'Done' ? 'selected' : '' }}>Done</option>
            </select>
        </form>
    </div>
</div>
