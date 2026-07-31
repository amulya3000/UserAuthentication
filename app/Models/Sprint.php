<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'notes', 'is_active', 'status'];

    public function backlogs()
    {
        return $this->hasMany(Backlog::class);
    }

    public function getCompletionPercentageAttribute()
    {
        $total = $this->backlogs->count();
        if ($total === 0) return 0;
        $done = $this->backlogs->where('status', 'Done')->count();
        return round(($done / $total) * 100);
    }

    public function getTaskCountsAttribute()
    {
        return [
            'total' => $this->backlogs->count(),
            'todo' => $this->backlogs->where('status', 'To Do')->count(),
            'in_progress' => $this->backlogs->where('status', 'In Progress')->count(),
            'done' => $this->backlogs->where('status', 'Done')->count(),
            'on_hold' => $this->backlogs->where('status', 'On Hold')->count(),
            'cancelled' => $this->backlogs->where('status', 'Cancelled')->count(),
        ];
    }
}
