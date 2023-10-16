<?php

namespace Database\Seeders;

use App\Models\JobList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobListData = [];

        for ($i = 1; $i <= 10; $i++) {
            $jobListData[] = [
                'title' => "Job {$i}",
                'description' => "Description for Job {$i}",
                'assigned_date' => null,
                'status' => 'Unassigned',
                'assessment' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        JobList::insert($jobListData);
    }
}
