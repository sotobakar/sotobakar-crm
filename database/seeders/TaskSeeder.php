<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $completedProjects = Project::completed()->get();
        $unfinishedProjects = Project::unfinished()->get();

        $completedStatus = TaskStatus::firstOrCreate(['name' => 'Completed']);
        $onGoingStatus = TaskStatus::firstOrCreate(['name' => 'On Going']);
        $notStartedStatus = TaskStatus::firstOrCreate(['name' => 'Not Started']);
        // Create 10 completed tasks on each completed projects
        foreach ($completedProjects as $project) {
            Task::factory()
                ->completed()
                ->count(10)
                ->for($project)
                ->for($completedStatus)
                ->create();
        }

        // Create 5 completed, 3 ongoin, 2 not started
        foreach ($unfinishedProjects as $project) {
            Task::factory()
                ->completed()
                ->count(5)
                ->for($project)
                ->for($completedStatus)
                ->create();

            Task::factory()
                ->count(3)
                ->for($project)
                ->for($onGoingStatus)
                ->create();

            Task::factory()
                ->count(2)
                ->for($project)
                ->for($notStartedStatus)
                ->create();
        }
    }
}
