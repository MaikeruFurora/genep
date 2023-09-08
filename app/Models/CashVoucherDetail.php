<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashVoucherDetail extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $casts=[
        'amount'=>'double'
    ];

    public function cashvoucher(){
        return $this->belongsTo(CashVoucher::class);
    }

    public function chart_account(){
        return $this->belongsTo(ChartAccount::class);
    }
}
