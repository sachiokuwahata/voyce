<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClientDetail;
use App\Models\Client;
use App\Models\DynamicItem;
use App\Models\CompanyDynamicItem;

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

        return redirect()->route('demand.showAll'); //不完全
    }

    
    public function itemEntry()
    {
        return view('client.item_entry');
    }


    public function itemEntryDone(Request $request)
    {

        $user = Auth::user();


        DB::transaction(function () use ($request, $user) {

            $data_type_id = $request->input('data_type_id');

            $dynamicitem = DynamicItem::create([
                'label' => $request->input('label'),
                'required' => $request->boolean('required'),
                'data_type_id' => $data_type_id,
            ]);

            CompanyDynamicItem::create([
                'company_id' => $user->company_id,
                'dynamic_item_id' => $dynamicitem->id,
            ]);          
    
            if($data_type_id == 4){
    
                // 確認：選択肢の登録処理方法
                $new_dynamicitem_id = $dynamicitem->id;
                $choices_str = $request->input('choices');
    
                $choices = explode(",",$choices_str);
                foreach ($choices as $choice){
                    DynamicItemChoice::create([
                        'dynamic_item_id' => $new_dynamicitem_id,
                        'choices' => $choice,
                    ]);
                }
            }    
        });

        return redirect()->route('demand.showItemAll');
    }

}
