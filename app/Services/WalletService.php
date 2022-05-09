<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Company;

class WalletService
{
    private $hiring_stage;
    public $total = 0;

    public function __construct($hiring_stage)
    {
        $this->hiring_stage = $hiring_stage;
    }

    public function scan($status,$company_id)
    {
      $this->total = $this->getTotalCoins($status,$company_id);
    }

    public function getTotalCoins($status,$company_id)
    { 
        $rule = $this->hiring_stage[$status];

        $this->total = Wallet::where('company_id',$company_id)->value('coins');
         
        if($rule == 'reduce_wallet'){

            $this->total = $this->total - 5;

            Wallet::where('company_id',$company_id)->update(['coins'=>$this->total]);

        } elseif($rule == 'restore_wallet') {
            
            $this->total = $this->total < 20 ? $this->total+5 : $this->total;

            Wallet::where('company_id',$company_id)->update(['coins'=>$this->total]);
    
        }

        return $this->total;
    }
}
