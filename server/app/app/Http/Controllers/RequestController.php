<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;

class RequestController extends Controller
{
    //
    public function index()
    {
        return view('request.request');
    }

    public function store(Request $request)
    {        
        $demand = new Demand;
        $demand->values = $request->input('values');
        $demand->save();

        return redirect('/requestALL');
    }




}
