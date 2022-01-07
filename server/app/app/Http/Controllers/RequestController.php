<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\DynamicItem;

class RequestController extends Controller
{
    //
    public function index()
    {
        $dynamicitems = DynamicItem::all();

        return view('request.request', compact('dynamicitems'));
    }

    public function item()
    {
        return view('request.requestitem');
    }


    public function requestItemDone(Request $request)
    {
        $dynamicitem = new DynamicItem;
        $dynamicitem->label =  $request->input('label');
        $dynamicitem->save();
        return view('request.requestItemAll');
    }

    public function requestItemAll()
    {
        $dynamicitems = DynamicItem::all();

        return view('request.requestItemAll', compact('dynamicitems'));
    }


    public function store(Request $request)
    {        

        $dynamicitems = DynamicItem::all();

            foreach($dynamicitems as $dynamicitem){
                $id = $dynamicitem->id;
                $demand = new Demand;
                $demand->values = $request->input($id);
                $demand->dynamic_item_id = $id;
                $demand->save();        
            }
    
        return redirect('/requestALL');
    }




}
