@extends('testlayout.app')

@section('content')

<div>
                <form method="POST" action="{{ route('demand.entryDone') }}">
                @csrf
                
                <label for="name" class="h4">企業</label>
                <select name ="client_id" class="form-control">
                        @foreach ($myClients as $myClient)
                            <option value="{{$myClient->id}}" selected>{{$myClient->client_name}}</option>
                        @endforeach
                </select>
                
                @foreach ($demanditems as $demanditem)
                    <div>
                        <div>
                            <label for="name" class="h4">{{ $demanditem->dynamicitem->label }}</label>

                            @if($demanditem->dynamicitem->data_type_id == 1)
                                <input type="text" id="" name="values_{{$demanditem->dynamicitem->id}}" >
                            @elseif ($demanditem->dynamicitem->data_type_id == 2)
                                <input type="number" id="" name="values_{{$demanditem->dynamicitem->id}}" >
                            @elseif ($demanditem->dynamicitem->data_type_id == 3)
                                <textarea name="values_{{$demanditem->dynamicitem->id}}" rows="4" cols="40">記入します。</textarea>
                            @elseif ($demanditem->dynamicitem->data_type_id == 4)

                                <select name ="values_{{$demanditem->dynamicitem->id}}" class="form-control">
                                    @foreach ($demanditem->dynamicitem->choices as $choice)
                                        <option value="{{$choice->choices}}" selected>{{$choice->choices}}</option>
                                    @endforeach
                                </select>

                            @else
                                <!-- 本来であれば不要 -->
                                <input type="text" id="" name="values_{{$demanditem->dynamicitem->id}}" >
                            @endif
                        </div>

                        <div>
                            <!-- 必須項目の処理をする必要有り -->
                            @if ($demanditem->dynamicitem->required)
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
