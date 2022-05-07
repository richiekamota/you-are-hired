<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'description','strengths','status']; 

    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_candidate','candidate_id','company_id');
    }
}
