<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessPartnerController extends Controller
{
    public function index(){
        return view('bpMaster.index');
    }
}
