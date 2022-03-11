<x-app-layout>
<x-slot name="slot">

            <div>
                <form method="POST" action="{{ route('client.entryDone') }}">
                @csrf

                <label for="name" class="h4">企業名</label>
                <input type="text" id="" name="client_name">

                @foreach ($CompanyDynamicItems as $CompanyDynamicItem)
                    <div>
                        <div>
                        <label for="name" class="h4">{{ $CompanyDynamicItem->dynamicitem->label }}</label>

                            @if($CompanyDynamicItem->dynamicitem->data_type_id == 1)
                                <input type="text" id="" name="{{$CompanyDynamicItem->dynamicitem->id}}" >
                            @elseif ($CompanyDynamicItem->dynamicitem->data_type_id == 2)
                                <input type="number" id="" name="{{$CompanyDynamicItem->dynamicitem->id}}" >
                            @elseif ($CompanyDynamicItem->dynamicitem->data_type_id == 3)
                                <textarea name="{{$CompanyDynamicItem->dynamicitem->id}}" rows="4" cols="40">記入します。</textarea>
                            @elseif ($CompanyDynamicItem->dynamicitem->data_type_id == 4)

                                <select name ="{{$CompanyDynamicItem->dynamicitem->id}}" class="form-control">
                                    @foreach ($CompanyDynamicItem->dynamicitem->choices as $choice)
                                        <option value="{{$choice->choices}}" selected>{{$choice->choices}}</option>
                                    @endforeach
                                </select>

                            @else
                                <!-- 本来であれば不要 -->
                                <input type="text" id="" name="{{$CompanyDynamicItem->dynamicitem->id}}" >
                            @endif
                        </div>

                        <div>
                            <!-- 必須項目の処理をする必要有り -->
                            @if ($CompanyDynamicItem->dynamicitem->required)
                               <div class="small">
                                   ※入力必須の項目
                               </div> 
                            @endif
                        </div>

                    </div>
                @endforeach

                    <button type="submit" class="btn">
                        保存する
                    </button>
                </form>
            </div>

            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach

    </x-slot>
</x-app-layout>

