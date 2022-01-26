@extends('testlayout.app')

@section('content')

<div>
                <form method="POST" action="{{ route('client.entryDone') }}">
                @csrf

                <input type="text" id="" name="" >


                    <button type="submit" class="btn">
                        保存する
                    </button>
                </form>
            </div>

            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach


@endsection
