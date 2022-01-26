@extends('testlayout.app')

@section('content')

<div>
                <form method="POST" action="{{ route('demand.entryDone') }}">
                @csrf

                <label for="name" class="h4">企業</label>
                <select name ="client_id" class="form-control">
                        @foreach ($myClients as $myClient)
                            <option value="{{$myClient->id}}" selected>idが{{$myClient->id}}企業</option><!-- 本来であれば企業名を反映 -->                            
                        @endforeach
                </select>

                @foreach ($dynamicitems as $dynamicitem)
                    <div>
                        <div>
                            <label for="name" class="h4">{{ $dynamicitem->label }}</label>

                            @if($dynamicitem->data_type_id == 1)
                                <input type="text" id="" name="{{$dynamicitem->id}}" >
                            @elseif ($dynamicitem->data_type_id == 2)
                                <input type="number" id="" name="{{$dynamicitem->id}}" >
                            @elseif ($dynamicitem->data_type_id == 3)
                                <textarea name="{{$dynamicitem->id}}" rows="4" cols="40">記入します。</textarea>
                            @elseif ($dynamicitem->data_type_id == 4)

                                <select name ="{{$dynamicitem->id}}" class="form-control">
                                    @foreach ($dynamicitem->choices as $choice)
                                        <option value="{{$choice->choices}}" selected>{{$choice->choices}}</option>
                                    @endforeach
                                </select>

                            @else
                                <!-- 本来であれば不要 -->
                                <input type="text" id="" name="{{$dynamicitem->id}}" >
                            @endif
                        </div>

                        <div>
                            <!-- 必須項目の処理をする必要有り -->
                            @if ($dynamicitem->required)
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


@endsection
