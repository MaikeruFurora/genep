<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartAccount extends Model
{
    use HasFactory;

    protected $casts=[
        'isActive'=>'boolean'
    ];

    protected $guarded=[];

    public function cashvoucher_detail(){
        return $this->hasMany(CashVoucherDetail::class);
    }
    

    public static function getCode(){

        $res = Static::orderBy('id', 'DESC')->whereDate('created_at',Carbon::now())->first();

        if (!is_null($res)) {
            $iterate = (strtotime(date("Ymd",strtotime($res->created_at)))==strtotime(date("Ymd"))) ? (intval(Static::whereDate('created_at',Carbon::now())->count())+1) : 1;
        }else{
            $iterate = 1;
        }

        $series = strtoupper('GL').date("y").'-'.date("md").sprintf('%02s', $iterate);

        return $series;   
    }

    

}
