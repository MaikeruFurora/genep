<?php

namespace App\Exports;

use App\Models\CashVoucher;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CashVoucherExport  implements FromView,ShouldAutoSize
{

    public $from;

    public $to;

    public $branch;

    public function __construct(String $from, String $to, String $branch)
    {

        $this->from = $from;

        $this->to = $to;

        $this->branch = $branch;


    }


    public function view() : View
    {

        $dataFrom = date('Y-m-d',strtotime($this->from));
        $dataTo   = date('Y-m-d',strtotime($this->to));
        
        $data = CashVoucher::whereBetween('cvdate',[$dataFrom,$dataTo])->where('branch_id',$this->branch)->get();

        return view('export.summary-report',compact('data'));

    }
}
