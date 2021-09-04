<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientStatus;
use App\Models\ClientType;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::factory()
            ->count(5)
            ->for(ClientType::firstOrCreate(['name' => 'Lead']))
            ->for(ClientStatus::firstOrCreate(['name' => 'active']))
            ->create();

        Client::factory()
            ->count(5)
            ->for(ClientType::firstOrCreate(['name' => 'Lead']))
            ->for(ClientStatus::firstOrCreate(['name' => 'inactive']))
            ->create();

        Client::factory()
            ->count(5)
            ->for(ClientType::firstOrCreate(['name' => 'Customer']))
            ->for(ClientStatus::firstOrCreate(['name' => 'active']))
            ->create();

        Client::factory()
            ->count(5)
            ->for(ClientType::firstOrCreate(['name' => 'Customer']))
            ->for(ClientStatus::firstOrCreate(['name' => 'inactive']))
            ->create();
    }
}
