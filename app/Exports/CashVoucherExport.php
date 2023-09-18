<?php

namespace App\Exports;

use App\Models\Branch;
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

        $dateFrom = date('Y-m-d',strtotime($this->from));
        $dateTo   = date('Y-m-d',strtotime($this->to));
        $branch   = Branch::find($this->branch);
        
        $data = CashVoucher::whereBetween('cvdate',[$dateFrom,$dateTo])->where('branch_id',$this->branch)->orderBy('created_at', 'asc')->get();

        return view('export.summary-report',compact('data','branch','dateFrom','dateTo'));

    }
}
