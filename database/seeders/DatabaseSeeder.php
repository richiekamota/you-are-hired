<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Candidate::factory(10)->create();

        Company::factory(3)->create()->each(function($company) {

            $wallet = Wallet::factory()->create([
                'company_id' => $company->id
            ]);
        
            $company->wallet()->save($wallet);
        });
        
    } 
}
