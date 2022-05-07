<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Company;
use App\Models\Candidate;
use App\Services\WalletService;


class HiringTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public $employer;
    public $candidate;

    public function setUp():void 
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->company = Company::first();
        $this->candidate = Candidate::first();
    }

    public function test_company_can_contact_candidate()
    {
        $response = $this->post('/candidates-contact/'.$this->candidate->id.'/'.$this->company->id);

        $this->assertDatabaseHas('candidates',[
            'id' => $this->candidate->id,
            'status' => 'Contacted'
        ]);

        $this->assertDatabaseHas('company_candidate', [
            'company_id' => $this->company->id,
            'candidate_id' => $this->candidate->id,
            'status' => 'Contacted'
        ]);

        $hiring_stage = [
            'CONT' => 'reduce_wallet',
            'HIRE' => 'restore_wallet'
        ];

        $co = new WalletService($hiring_stage);
        $co->scan('CONT',$this->company->id);
        $this->assertEquals(15,$co->total);

        $response->assertStatus(200);
    }
}