<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CashVoucher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CashVoucherExport;
use App\Helper\Helper;
use App\Models\BPMasterData;
use FPDM;
use PDF;

class VoucherController extends Controller
{
    public function index(){
        $branchList         = Branch::get(['id','name']);
        $bpMasterList       = BPMasterData::get(['id','name']);
        $cashVoucherList    = CashVoucher::with('cashvoucher_detail','cashvoucher_detail.chart_account','branch','branch.company','bp_master_data')->get();
        return view('voucher',compact('cashVoucherList','branchList','bpMasterList'));
    }

    public function printCV(CashVoucher $cashVoucher){

        //  $debit = $cashVoucher->cashvoucher_detail;
        // $credit = $cashVoucher->cashvoucher_detail->get(['ewTax']);

        // return view("print.voucher-print",compact('cashVoucher'));

        $pdf = PDF::loadView('print/voucher-pdf',compact('cashVoucher'));

        return $pdf->stream('voucher-pdf.php');

    }

    public function printCheque(CashVoucher $cashVoucher,$type){

        $dateArr =  str_split(date("mdY",strtotime($cashVoucher->cvdate)));
        // return explode("",);
        $date = array(
            'monthone'  =>null,
            'monthtwo'  =>null,
            'dayone'    =>null,
            'daytwo'    =>null,
            'yearone'   =>null,
            'yeartwo'   =>null,
            'yearthree' =>null,
            'yearfour'  =>null,
        );
        $i=0;
        foreach ($date as $key => $value) {
            $date[$key]=$dateArr[$i];
            ++$i;
        }

        $fields = array(
            'name'      => $cashVoucher->bp_master_data->name,
            'amount'    => number_format($cashVoucher->amount,2),
            'word'      => strtoupper(Helper::numberToWord($cashVoucher->amount)),
        );

        $combine = array_merge($fields,$date);
        
        $pdf = new FPDM('file/cheque-'.$type.'.pdf');
        $pdf->Load($combine, true);
        $pdf->Merge();
        $pdf->Output();

    }

    public function downloadSummary(Request $request){

        return Excel::download(new CashVoucherExport($request->from,$request->to,$request->branch),'Report.xlsx');

    }

}
