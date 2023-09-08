<?php

namespace App\Http\Controllers;

use App\Http\Requests\BPMasterRequest;
use App\Models\BPMasterData;
use App\Models\CashVoucher;
use Illuminate\Http\Request;

class BusinessPartnerController extends Controller
{
    public function index(){
        
        $code   = BPMasterData::getCode();
        $bplist = BPMasterData::get();

        return view('bpMaster.index',compact('code','bplist'));
    }

    public function store(BPMasterRequest $request){

        $data =  (empty($request->id)) 
        ? BPMasterData::create($this->requestInput($request))
        : BPMasterData::find($request->id)->update($this->requestInput($request));

        if ($data) {
            return back()->with(['msg'=>'Successfully saved GL account','action'=>'success']);
        }else{
            return  back()->with(['msg'=>'Successfully saved GL account','action'=>'success']);
        }

    }

    public function requestInput($request){
        return [
            'code'    => $request->code,
            'name'    => $request->name,
            'tin'     => $request->tin,
            'address' => $request->address,
            'isActive'=> !$request->has('isActive'),
        ];
    }

}
