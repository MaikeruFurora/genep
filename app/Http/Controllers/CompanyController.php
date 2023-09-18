<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        
        $code = Company::getCode();
        $companies = Company::with('branch')->get();
        return view('company.index',compact('code','companies'));

    }

    public function store(CompanyRequest $request){

        $data =  (empty($request->id)) 
        ? Company::create($this->requestInput($request))
        : Company::find($request->id)->update($this->requestInput($request));

        if ($data) {
            return back()->with(['msg'=>'Successfully saved GL account','action'=>'success']);
        }else{
            return  back()->with(['msg'=>'Successfully saved GL account','action'=>'success']);
        }
    }

    public function requestInput($request){
        return [
            'code'          => $request->code,
            'acronym'       => $request->acronym,
            'name'          => strtoupper($request->name),
            'cvnumber_start'=> $request->cvnumber_start,
            'isActive'      => !$request->has('isActive'),
        ];
    }
}
