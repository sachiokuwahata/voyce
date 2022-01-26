<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClientDetail;
use App\Models\Client;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    
                $client = Client::create([
                    'company_id' => $user->company_id,
                ]);

                $client_details = ClientDetail::create([
                    'client_group_id' => $client->id,
                    'company_id' => $user->company_id,
                    'dynamic_item_id' => $user->id, //不完全
                    'values' => $request->value,  //不完全
                ]);

            });

        return redirect()->route('demand.showAll');
    }    
}
