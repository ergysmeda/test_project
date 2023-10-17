<?php

namespace App\Services;

use App\Models\JobList;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JobService
{

    public function listJobs()
    {
        return JobList::with('schedules')->get();
    }

    public function unassigned()
    {
        return JobList::unassigned()->all();
    }

    public function getAvailableJob($id)
    {
        return JobList::unassigned()->where('id',$id);
    }

    public function getAssignedJob($id)
    {
        return JobList::assignedToMe()->where('id',$id);
    }

    public function getAdjustedDate()
    {
        $offset = Auth::user()->getTimezoneOffset();
        list($hours, $minutes) = explode(':', $offset);
        $offsetInMinutes = ($hours * 60) + $minutes;
        $currentDateTime = Carbon::now();
        return $currentDateTime->addMinutes($offsetInMinutes);
    }

    public function assign($job)
    {
        $dateTime = $this->getAdjustedDate();

         Schedule::create([
            'date' => $dateTime->toDateString(),
            'job_id' => $job->id,
            'user_id' => Auth::user()->getAuthIdentifier(),
        ]);

        $job->status = 'Assigned';
        $job->assigned_date = $dateTime->toDateTimeString();
        $job->updated_at = $dateTime->toDateTimeString();

        if($job->save()){
            return $job;
        }

        return false;
    }

    public function complete($job,$validator)
    {
        $dateTime = $this->getAdjustedDate();

        $job->status = 'Completed';
        $job->assessment = $validator->assessment;
        $job->updated_at = $dateTime->toDateTimeString();

        if($job->save()){
            return $job;
        }

        return false;
    }
}
