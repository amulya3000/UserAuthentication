<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'notes', 'is_active'];

    public function backlogs()
    {
        return $this->hasMany(Backlog::class);
    }
}
