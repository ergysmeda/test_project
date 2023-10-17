<?php

namespace App\Http\Controllers;

use App\Models\TimeZone;
use Illuminate\Http\Request;

class TimeZoneController extends Controller
{
    public function index()
    {
        return TimeZone::select(['id','name','offset'])->get();
    }
}
