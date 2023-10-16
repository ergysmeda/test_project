<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobList()
    {
        return $this->belongsTo(JobList::class, 'job_id');
    }
}
