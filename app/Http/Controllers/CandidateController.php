<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Wallet;
use App\Notifications\CandidateContactedNotification;
use App\Notifications\CandidateHiredNotification;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Services\WalletService;

class CandidateController extends Controller
{

    public $hiring_stage = [
        'CONT' => 'reduce_wallet',
        'HIRE' => 'restore_wallet'
    ];

    public function index()
    {
       $candidates = Candidate::all();
       $id = intval(request()->get('id'));
       $coins = Wallet::where('id',$id)->value('coins');
       $companies = Company::all();
       return view('candidates.index', compact('candidates', 'coins','companies'));
    }

    public function contact($id,$company_id){

        $can = Candidate::findOrFail($id);
        $companies = Company::all();
        $candidates = Candidate::all();

        $candidate = $can->update(['status'=>'Contacted']);

        $can->companies()->sync([
            ['company_id' => $company_id],
            ['candidate_id' => $id],
            ['status'=>'Contacted']]);  

            //Comment out this when you need to run feature tests
            $co = new WalletService($this->hiring_stage);
            $co->scan('CONT',$company_id); 
            $coins = $co->total;   
            
            //Comment out this when you need to run feature tests
            Notification::send($can,new CandidateContactedNotification($can));   
           
            //Comment out this when you need to run feature tests   
            return view('candidates.index', compact('candidates', 'coins','companies'));
    }

    public function hire($id,$company_id){

        $can = Candidate::findOrFail($id);
        $companies = Company::all();
        $candidates = Candidate::all();

        $candidate = $can->update(['status'=>'Hired']);

        //For feature tests you can populate the pivot table using this
        // $can->companies()->attach(
        //     ['company_id' => $company_id,
        //     'candidate_id' => $id],
        //     ['status'=>'Hired']);   
        
        //For live running you can populate the pivot table using this    
        $can->companies()->sync([
            ['company_id' => $company_id],
            ['candidate_id' => $id],
            ['status'=>'Hired']]);
            
        //Comment out this when you need to run feature tests
        $co = new WalletService($this->hiring_stage);
        $co->scan('HIRE',$company_id); 
        $coins = $co->total; 

        //Comment out this when you need to run feature tests
        Notification::send($can,new CandidateHiredNotification($can));  
        //Comment out this when you need to run feature tests
        return view('candidates.index', compact('candidates', 'coins','companies'));            
    }
}