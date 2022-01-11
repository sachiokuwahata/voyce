<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\DynamicItem;
use App\Models\DynamicItemChoice;

class DemandController extends Controller
{
    //

    public function entry()
    {
        $dynamicitems = DynamicItem::all();

        return view('demand.entry', compact('dynamicitems'));
    }

    public function itemEntry()
    {
        return view('demand.item_entry');
    }


    public function itemEntryDone(Request $request)
    {
        $data_type_id = $request->input('data_type_id');

        $dynamicitem = DynamicItem::create([
            'label' => $request->input('label'),
            'required' => $request->boolean('required'),
            'data_type_id' => $data_type_id,
        ]);

        $new_dynamicitem_id = $dynamicitem->id;

        if($data_type_id == 4){
            DynamicItemChoice::create([
                'dynamic_item_id' => $new_dynamicitem_id,
                'choices' => $request->input('choicesA'),
            ]);    
        }


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

    public function entryDone(Request $request)
    {        

        $dynamicitems = DynamicItem::all();

            foreach($dynamicitems as $dynamicitem){
                $id = $dynamicitem->id;
                Demand::create([
                    'values' => $request->input($id),
                    'dynamic_item_id' => $id                    
                ]);                
            }
    
        return redirect()->route('demand.showAll');
    }

}
