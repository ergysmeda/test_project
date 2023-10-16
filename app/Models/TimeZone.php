<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeZone extends Model
{
    use HasFactory;

    protected $table = 'time_zones';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
