<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class JobList extends Model
{
    use HasFactory;

    protected $table = 'job_list';

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'job_id');
    }

    public function scopeUnassigned($query)
    {
        return $query->where('assigned_date',null);
    }
    public function scopeAssignedToMe($query)
    {
        return $query->whereNotNull('assigned_date')
            ->whereHas('schedules', function ($subQuery) {
                $subQuery->where('user_id', Auth::id());
            });
    }
}
