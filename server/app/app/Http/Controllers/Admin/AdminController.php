<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Company;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{

    public function companyEntry()
    {
        return view('admin.register');
    }

    public function companyRegister(Request $request)
    {

        DB::transaction(function () use ($request) {
    
            $company = Company::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
            ]);
        });

        return redirect()->route('admin.home'); //不完全        
    }

}
