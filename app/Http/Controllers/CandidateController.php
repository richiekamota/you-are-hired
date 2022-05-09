<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Notifications\CandidateContactedNotification;
use App\Notifications\CandidateHiredNotification;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CandidateController extends Controller
{
    public function index()
    {
       $candidates = Candidate::all();
       $coins = Company::find(1)->coins;
       $companies = Company::all();
      return view('candidates.index', compact('candidates', 'coins','companies'));
    }

    public function contact($id,$company_id){

        $can = Candidate::findOrFail($id);

        $candidate = $can->update(['status'=>'Contacted']);
        
        $can->companies()->attach([
            'company_id' => $company_id,
            'candidate_id' => $id],
            ['status'=>'Contacted']);  

            $candidates = Candidate::all();
            
            Notification::send($candidates,new CandidateContactedNotification($can));    
    }

    public function hire($id,$company_id){

        $can = Candidate::findOrFail($id);

        $candidate = $can->update(['status'=>'Hired']);

        $can->companies()->attach([
            'company_id' => $company_id,
            'candidate_id' => $id],
            ['status'=>'Hired']);    

            $candidates = Candidate::all();

            Notification::send($candidates,new CandidateHiredNotification($can));      
    }
}