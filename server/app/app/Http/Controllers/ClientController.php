<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClientDetail;


class ClientController extends Controller
{
    //

    public function entry()
    {

        return view('client.entry');
    }


    public function entryDone(Request $request)
    {
        $user = Auth::user();

            DB::transaction(function () use ($request, $user) {
    
                $demand = ClientDetail::create([
                    'client_id' => $user->id,
                    'company_id' => $user->company_id,
                    'dynamic_item_id' => $user->id,
                    'values' => $user->id,  
                ]);

    
            });

        return redirect()->route('demand.showAll');
    }    
}
