<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CashVoucher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CashVoucherExport;
use PDF;

class VoucherController extends Controller
{
    public function index(){
        $branchList         = Branch::get(['id','name']);
        $cashVoucherList    = CashVoucher::with('cashvoucher_detail','cashvoucher_detail.chart_account','branch','branch.company','bp_master_data')->get();
        return view('voucher',compact('cashVoucherList','branchList'));
    }

    public function printCV(CashVoucher $cashVoucher){

        //  $debit = $cashVoucher->cashvoucher_detail;
        // $credit = $cashVoucher->cashvoucher_detail->get(['ewTax']);

        // return view("print.voucher-print",compact('cashVoucher'));

        $pdf = PDF::loadView('print/voucher-pdf',compact('cashVoucher'));

        return $pdf->stream('voucher-pdf.php');

    }

    public function downloadSummary(Request $request){

        return Excel::download(new CashVoucherExport($request->from,$request->to,$request->branch),'Report.xlsx');

    }

}
