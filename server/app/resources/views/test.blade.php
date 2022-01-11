

@extends('testlayout.app')

@section('content')
    <p>このページはインデックスページです。</p>

            <div class="h1">
                h1
                <a href="{{ route('demand.entry') }}">
                    要望作成場所
                </a>
            </div>
            <div class="h2">
                h2
                <a href="{{ route('demand.item.entry') }}">
                    要望項目作成場所
                </a>
            </div>
            <div class="h3">
                h3
            </div>
            <div class="h4">
                h4
            </div>

@endsection
