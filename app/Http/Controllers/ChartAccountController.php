<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChartAccountRequest;
use App\Models\ChartAccount;
use Illuminate\Http\Request;

class ChartAccountController extends Controller
{
    public function index(){
        
        $code = ChartAccount::getCode();
        $accounts = ChartAccount::get();
        return view('chartAccount.index',compact('code','accounts'));
    }

    public function store(ChartAccountRequest $request){

        $data =  (empty($request->id)) 
        ? ChartAccount::create($this->requestInput($request))
        : ChartAccount::find($request->id)->update($this->requestInput($request));

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
            'isActive'=> !$request->has('isActive'),
        ];
    }

}
