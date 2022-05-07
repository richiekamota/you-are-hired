<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class,'company_candidate','company_id','candidate_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
