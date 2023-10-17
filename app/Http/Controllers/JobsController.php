<?php

namespace App\Http\Controllers;

use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    public JobService $jobService;

    /**
     * @param JobService $jobService
     */
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }


    public function index()
    {
        return $this->jobService->listJobs();
    }

    public function unassignedJobs()
    {
        return $this->jobService->unassigned();
    }

    public function assign($id)
    {

        $job = $this->jobService->getAvailableJob($id);

        if(!$job->count() == 1)
        {
            return response()->json(['message' => 'Job is Not available to be assigned'], Response::HTTP_BAD_REQUEST);
        }


        $assigned = $this->jobService->assign($job->first());


        if (!$assigned) {
            return response()->json(['message' => 'Couldnt save job'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => 'Assigned Successfully', 'job' => $assigned], Response::HTTP_OK);

    }
    public function complete(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'assessment' => 'required', // Add any other validation rules you need
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $job = $this->jobService->getAssignedJob($id)->first();

        if(!$job->count() == 1)
        {
            return response()->json(['message' => 'Job is Not available to be completed'], Response::HTTP_BAD_REQUEST);
        }


        $completed = $this->jobService->complete($job,$request);


        if (!$completed) {
            return response()->json(['message' => 'Couldnt save job'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => 'Completed Successfully', 'job' => $completed], Response::HTTP_OK);

    }
}
