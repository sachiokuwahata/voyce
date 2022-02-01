
@extends('testlayout.guest')

@section('content')
    <p>このページはインデックスページです。</p>

            @php
            $aaa = [
                    'aaaa' => 1,
                    'bbbb' => 2,
                    'cccc' => 3,
                    'dddd' => 4,
            ];
            @endphp


            <div id="wdr-component">The pivot table control will appear here</div>
            <script>
                var hoge = @json($aaa);

                var pivot = $("#wdr-component").webdatarocks({
                    toolbar: true,
                    report: {
                        dataSource: {
                            filename: "https://cdn.webdatarocks.com/data/data.csv"
                        }
                    }
                    // report: "https://cdn.webdatarocks.com/reports/report.json"
               });
            </script>

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
                <a href="{{ route('demand.showAll') }}">
                    要望一覧
                </a>
            </div>
            <div class="h4">
                h4
                <a href="{{ route('client.entry') }}">
                    クライアント作成
                </a>
            </div>

            <div class="h4">
                h4
                <a href="{{ route('client.item.entry') }}">
                    クライアント_項目の作成
                </a>
            </div>

@endsection
