<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectStatus;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = Client::customer()->active()->get();

        foreach ($clients as $client) {
            // Make a completed project
            Project::factory()
                ->count(1)
                ->completed()
                ->for($client)
                ->for(ProjectStatus::firstOrCreate(['name' => 'Completed']))
                ->create();

            // Make a ongoing project
            Project::factory()
                ->count(1)
                ->for($client)
                ->for(ProjectStatus::firstOrCreate(['name' => 'On Going']))
                ->create();

            // Make a not started project
            Project::factory()
                ->count(1)
                ->for($client)
                ->for(ProjectStatus::firstOrCreate(['name' => 'Not Started']))
                ->create();
        }
    }
}
