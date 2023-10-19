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
use App\Helper\Helper;
use App\Models\Branch;
use PDF;

class HomeController extends Controller
{
    public function index(){
        $branchList         = Branch::get(['id','name']);
        $bpMasterList       = BPMasterData::get(['id','name']);
        $chartofAccountList = ChartAccount::get(['id','name','cnt']);
        return view('home',compact('bpMasterList','chartofAccountList','branchList'));
    }


    
    public function store(Request $request){

        // return $request->all();
        
        $data =  CashVoucher::create([
                // 'code'              => CashVoucher::getVoucherCode(json_decode($request->company)->id),
                'bp_master_data_id' => $request->input('bp_master_data') ?? null,
                'branch_id'         => $request->input('branch'),
                'particulars'       => $request->input('particulars'),
                'payment_others'    => $request->input('payment_others'),
                'cvno'              => $request->input('cvno'),
                'cvdate'            => $request->input('cvdate'),
                'bank'              => $request->input('bank'),
                'checkno'           => $request->input('checkno'),
                'amount'            => Helper::cleanNumberByFormat($request->amount)
        ]);


        foreach ($request->input('chartAccount') as $key => $value) {
        
            CashVoucherDetail::create([
                'cash_voucher_id'   => $data->id,
                'chart_account_id'  => $value,
                'amount'            => Helper::cleanNumberByFormat($request->input('netAmount')[$key]),
                'inputVat'          => Helper::cleanNumberByFormat($request->input('inputVat')[$key]),
                'ewTaxPercent'      => Helper::cleanNumberByFormat($request->input('ewTaxPercent')[$key]),
                'ewTax'             => Helper::cleanNumberByFormat($request->input('ewTax')[$key]),
            ]);

        }

        return back()->with([
                'msg'       => 'Successfully saved Data',
                'action'    => 'success',
                'id'        => $data->id,
                'checkno'   => $data->checkno,
            ]);

    }

    

   

}
