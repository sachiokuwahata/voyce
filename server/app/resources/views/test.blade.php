<x-guest-layout>
<x-slot name="slot">
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

</x-slot>
</x-guest-layout>
