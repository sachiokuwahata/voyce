<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\DemandDetail;

use App\Models\DynamicItem;
use App\Models\DynamicItemChoice;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DemandController extends Controller
{
    //

    public function entry()
    {
        $dynamicitems = DynamicItem::all();

        return view('demand.entry', compact('dynamicitems'));
    }

    public function entryDone(Request $request)
    {
        $user = Auth::user();

            DB::transaction(function () use ($request, $user) {
    
                $demand = Demand::create([
                    'user_id' => $user->id,                            
                ]);

                $dynamicitems = DynamicItem::all();
    
                foreach($dynamicitems as $dynamicitem){

                    $id = $dynamicitem->id;
                    $values = $request->input($id);

                    if ($values) {
                        $demand_details = DemandDetail::create([
                            'values' => $request->input($id),
                            'dynamic_item_id' => $id,
                            'demand_group_id' => $demand->id,
                        ]);

                    } elseif($values == null && $dynamicitem->required == 1) {
                        // input空白 && 必須項目
                        $request->validate([
                            'values' => 'required',
                            // 'dynamic_item_id' => 'required | integer | between:0,150',
                            // 'demand_group_id' => 'required | integer | between:0,150'
                        ]);
                    } else {
                        // input空白 && 任意項目 -> 処理しない
                    }

                }
            });

        return redirect()->route('demand.showAll');
    }



    public function itemEntry()
    {
        return view('demand.item_entry');
    }


    public function itemEntryDone(Request $request)
    {

        DB::transaction(function () use ($request) {

            $data_type_id = $request->input('data_type_id');

            $dynamicitem = DynamicItem::create([
                'label' => $request->input('label'),
                'required' => $request->boolean('required'),
                'data_type_id' => $data_type_id,
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

    public function showItemAll()
    {
        $dynamicitems = DynamicItem::all();

        return view('demand.showItemAll', compact('dynamicitems'));
    }


    public function showAll()
    {
        return view('demand.showAll');
    }


}
