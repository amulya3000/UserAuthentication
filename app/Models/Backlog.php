<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    protected $fillable = ['task_id', 'title', 'type', 'sprint_id', 'status'];

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }
}
