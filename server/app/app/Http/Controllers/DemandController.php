<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\DemandDetail;

use App\Models\DynamicItem;
use App\Models\DynamicItemChoice;
use App\Models\Client;
use App\Models\CompanyDynamicItem;
use App\Models\DynamicItemRole;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DemandController extends Controller
{
    //

    public function entry()
    {
        $user = Auth::user();
        $company_id = $user->company_id;
        
        $myClients = Client::where('company_id', $company_id)->get();
        $myCompanyDynamicItems = CompanyDynamicItem::where('company_id', $company_id)->get();

        // $where = [
        //     ['company_id', '=', $company_id],
        // ];

        // // 動的項目から企業に関係する動的項目を除外
        // $whereNot = [];
        // foreach($myCompanyDynamicItems as $myCompanyDynamicItem){
        //     array_push($whereNot, [ 'id', '<>', $myCompanyDynamicItem->dynamicitem->id]);       
        // } ;

        // $dynamicitems = DynamicItem::where($where)->where($whereNot)->get();

        $demanditems = DynamicItemRole::where('dynamic_item_type', 'demands')
                    ->whereHas('dynamicitem', function ($query) use($company_id) {
                        return $query->where('company_id', $company_id);
                    })
                    ->get();

        return view('demand.entry', compact('demanditems', 'myClients'));
        // return view('demand.entry', compact('dynamicitems', 'myClients'));
    }

    public function entryDone(Request $request)
    {
        $user = Auth::user();

            DB::transaction(function () use ($request, $user) {
    
                $demand = Demand::create([
                    'user_id' => $user->id,
                    'company_id' => $user->company_id,
                    'client_id'=> $request->client_id,
                ]);


                $company_id = $user->company_id;
                $myCompanyDynamicItems = CompanyDynamicItem::where('company_id', $company_id)->get();        
                $where = [
                    ['company_id', '=', $company_id],
                ];
                // $whereNot = [];
                // foreach($myCompanyDynamicItems as $myCompanyDynamicItem){
                //     array_push($whereNot, [ 'id', '<>', $myCompanyDynamicItem->dynamicitem->id]);       
                // } ;
                // $dynamicitems = DynamicItem::where($where)->where($whereNot)->get();        

                $demanditems = DynamicItemRole::where('dynamic_item_type', 'demands')
                ->whereHas('dynamicitem', function ($query) use($company_id) {
                    return $query->where('company_id', $company_id);
                })
                ->get();                

                // $dynamicitems = DynamicItem::where('company_id', $user->company_id)->get();
                
                $validationRule = [];


                foreach($demanditems as $demanditem){

                    $id = $demanditem->dynamic_item_id;
                    $values = $request->input("values_{$id}");

                    $rules = [$demanditem->required == 1 ? 'required': 'nullable'];

                    if($demanditem->data_type_id == 1){
                        $rules[] = 'string';
                        $rules[] = 'max:'.'10'; //$demanditem->size
                    }else if($demanditem->data_type_id == 2){
                        $rules[] = 'integer';
                    }

                    $validationRule = array_merge(
                        $validationRule, [
                            "values_{$id}" => $rules,
                        ],
                    );
    
                }

                $request->validate($validationRule);

                foreach($demanditems as $demanditem){

                    $id = $demanditem->dynamic_item_id;
                    $values = $request->input("values_{$id}");

                    $demand_details = DemandDetail::create([
                        'values' => $values,
                        'dynamic_item_id' => $id,
                        'demand_group_id' => $demand->id,
                    ]);

                }


                // foreach($dynamicitems as $dynamicitem){

                //     $id = $dynamicitem->id;
                //     $values = $request->input("values_{$id}");

                //     $rules = [$dynamicitem->required == 1 ? 'required': 'nullable'];

                //     if($dynamicitem->data_type_id == 1){
                //         $rules[] = 'string';
                //         $rules[] = 'max:'.'10'; //$dynamicitem->size
                //     }else if($dynamicitem->data_type_id == 2){
                //         $rules[] = 'integer';
                //     }

                //     $validationRule = array_merge(
                //         $validationRule, [
                //             "values_{$id}" => $rules,
                //         ],
                //     );
    
                // }

                // $request->validate($validationRule);

                // foreach($dynamicitems as $dynamicitem){

                //     $id = $dynamicitem->id;
                //     $values = $request->input("values_{$id}");

                //     $demand_details = DemandDetail::create([
                //         'values' => $values,
                //         'dynamic_item_id' => $id,
                //         'demand_group_id' => $demand->id,
                //     ]);

                //     // if ($values) {
                //     //     $demand_details = DemandDetail::create([
                //     //         'values' => $request->input($id),
                //     //         'dynamic_item_id' => $id,
                //     //         'demand_group_id' => $demand->id,
                //     //     ]);
                //     // } elseif($values == null && $dynamicitem->required == 1) {
                //     //     // input空白 && 必須項目
                //     //     $request->validate([
                //     //         'values' => 'required',
                //     //         // 'dynamic_item_id' => 'required | integer | between:0,150',
                //     //         // 'demand_group_id' => 'required | integer | between:0,150'
                //     //     ]);
                //     // } else {
                //     //     // input空白 && 任意項目 -> 処理しない
                //     // }

                // }
            });

        return redirect()->route('demand.showAll');
    }



    public function itemEntry()
    {
        return view('demand.item_entry');
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
                'company_id' => $user->company_id,                
            ]);
    
            DynamicItemRole::create([
                'dynamic_item_id' => $dynamicitem->id,
                'dynamic_item_type' => 'demands',
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

        $demands = Demand::all();
        // $demand_details = DemandDetail::all();
        // dd($demands->demand_details());

        return view('demand.showAll', compact('demands'));
    }


}
