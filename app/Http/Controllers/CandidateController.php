<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    public function index(){
       $candidates = Candidate::all();
       $coins = Company::find(1)->coins;
       $companies = Company::all();
      return view('candidates.index', compact('candidates', 'coins','companies'));
    }

    public function contact(Request $request,$id,$company_id){

        if ($request) {

            $can = Candidate::findOrFail($id);

            $candidate = $can->update(['status'=>'Contacted']);
            
            $can->companies()->attach([
                'company_id' => $company_id,
                'candidate_id' => $id
            ]);
        }    
       
    }

    public function hire(){
        // @todo
        // Your code goes here...
    }
}