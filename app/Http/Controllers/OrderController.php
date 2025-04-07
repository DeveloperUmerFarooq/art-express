<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('Orders.index');
    }

    public function store(Request $req){
        $req->validate([
            'address'=>'required',
            'tel'=>'required',
            'paymentMethod'=>'required',
        ]);
        if($req->paymentMethod=="card"){
            dd("card-payment");
        }
        else{
            dd($req->toArray());
        }
    }
}
