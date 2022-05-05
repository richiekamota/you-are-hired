<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Company;

class CandidateController extends Controller
{
    public function index(){
    $candidates = Candidate::all();
    $coins = Company::find(1)->coins;
    $companies = Company::all();
    return view('candidates.index', compact('candidates', 'coins','companies'));
}

    public function contact(){
        // @todo
        // Your code goes here...
    }

    public function hire(){
        // @todo
        // Your code goes here...
    }
}