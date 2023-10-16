<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobList extends Model
{
    use HasFactory;

    protected $table = 'job_list';

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'job_id');
    }
}
