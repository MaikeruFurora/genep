<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Company $company){

        return view("company.branch",compact('company'));

    }

    public function store(Request $request){

        // return $request;
        
        $data =  (empty($request->id)) 
        ? Branch::create($this->requestInput($request))
        : Branch::find($request->id)->update($this->requestInput($request));

        if ($data) {
            return back()->with(['msg'=>'Successfully saved','action'=>'success']);
        }else{
            return  back()->with(['msg'=>'Failed','action'=>'danger']);
        }

    }

    public function requestInput($request){
        return [
            'company_id'  => $request->company,
            'name'        => $request->name
        ];
    }
}
