<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashVoucher extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function bp_master_data(){
        return $this->belongsTo(BPMasterData::class);
    }

    public function cashvoucher_detail(){
        return $this->hasMany(CashVoucherDetail::class);
    }

    public static function getVoucherCode($company){

        $res = Static::count();

        $cvCode =  ($res<0) ? Company::find($company)->cvnumber_start : intval(Company::find($company)->cvnumber_start)+1;

        return 'CV'.$cvCode; 
    }
}
