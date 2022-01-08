<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\DynamicItem;

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
        $dynamicitem = DynamicItem::create([
            'label' => $request->input('label')
        ]);

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
