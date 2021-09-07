<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Opportunity;
use App\Models\OpportunityStatus;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $approvedStatus = OpportunityStatus::firstOrCreate(['name' => 'Approved']);
        $onGoingStatus = OpportunityStatus::firstOrCreate(['name' => 'On Going']);
        $declinedStatus = OpportunityStatus::firstOrCreate(['name' => 'Declined']);

        $leads = Client::OfType('Lead')->active()->get();

        foreach ($leads as $lead) {
            // Create approved opportunity
            Opportunity::factory()
                ->for($approvedStatus)
                ->for($lead)
                ->create();

            // Create on going opportunity
            Opportunity::factory()
                ->for($onGoingStatus)
                ->for($lead)
                ->create();

            // Create declined opportunity
            Opportunity::factory()
                ->for($declinedStatus)
                ->for($lead)
                ->create();
        }
    }
}
