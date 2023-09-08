<?php

namespace App\Http\Controllers;

use App\Models\BPMasterData;
use App\Models\CashVoucher;
use App\Models\CashVoucherDetail;
use App\Models\ChartAccount;
use App\Models\Company;
use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    public function index(){
        
        $companyList       = Company::get(['id','name']);
        $bpMasterList       = BPMasterData::get(['id','name']);
        $chartofAccountList = ChartAccount::get(['id','name','cnt']);
        $cashVoucherList = CashVoucher::with('cashvoucher_detail','cashvoucher_detail.chart_account','company','bp_master_data')->get();

        return view('home',compact('bpMasterList','chartofAccountList','companyList','cashVoucherList'));
    }


    
    public function store(Request $request){
        
        $data =  CashVoucher::create([
                // 'code'              => CashVoucher::getVoucherCode(json_decode($request->company)->id),
                'bp_master_data_id' => json_decode($request->bp_master_data)->id,
                'company_id'        => json_decode($request->company)->id,
                'particulars'       => $request->particulars,
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
    

}
