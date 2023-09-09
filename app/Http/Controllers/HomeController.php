<?php

namespace App\Http\Controllers;

use App\Models\BPMasterData;
use App\Models\CashVoucher;
use App\Models\CashVoucherDetail;
use App\Models\ChartAccount;
use App\Models\Company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CashVoucherExport;
use App\Models\Branch;
use PDF;

class HomeController extends Controller
{
    public function index(){
        
        $branchList         = Branch::get(['id','name']);
        $bpMasterList       = BPMasterData::get(['id','name']);
        $chartofAccountList = ChartAccount::get(['id','name','cnt']);
        $cashVoucherList = CashVoucher::with('cashvoucher_detail','cashvoucher_detail.chart_account','branch','branch.company','bp_master_data')->get();

        return view('home',compact('bpMasterList','chartofAccountList','branchList','cashVoucherList'));
    }


    
    public function store(Request $request){

        // return $request->branch;
        
        $data =  CashVoucher::create([
                // 'code'              => CashVoucher::getVoucherCode(json_decode($request->company)->id),
                'bp_master_data_id' => $request->bp_master_data ?? null,
                'branch_id'         => $request->branch,
                'particulars'       => $request->particulars,
                'payment_others'    => $request->payment_others,
                'cvno'              => $request->cvno,
                'cvdate'            => $request->cvdate,
                'bank'              => $request->bank,
                'checkno'           => $request->checkno,
                'amount'            => $request->amount,
        ]);

        $merge =  (array_merge(
            array_filter($request->debit, function($value) {return !is_null($value);}),
            array_filter($request->credit, function($value) {return !is_null($value);}))
        );

        foreach ($request->account as $key => $value) {
        
        CashVoucherDetail::create([
                'cash_voucher_id'   => $data->id,
                'chart_account_id'  => $request->input('account')[$key],
                'amount'            => $merge[$key],
            ]);
        }

        return back()->with(['msg'=>'Successfully saved GL account','action'=>'success']);

    }


    public function printCV(CashVoucher $cashVoucher){

        $debit = $cashVoucher->cashvoucher_detail->where("amount",'<',0);
        $credit = $cashVoucher->cashvoucher_detail->where("amount",'>',0);

        return view("print.voucher",compact('cashVoucher','debit','credit'));
        // $pdf = PDF::loadView('print.voucher');
        // $pdf->stream('print.voucher.pdf');
    }
    

    public function downloadSummary(){

        return Excel::download(new CashVoucherExport(),'Summary Report.xlsx');


    }

}
