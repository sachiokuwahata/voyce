<x-app-layout>
<x-slot name="slot">

<div>
                項目作成
            </div>

            <div>
                <form method="POST" action="{{ route('client.item.entryDone') }}">
                @csrf
                
                <div>
                    <label for="name">質問名称</label>                
                    <input type="text" id="" name="label">
                </div>

                <div>
                    <label for="name">必須 / 選択式</label>                
                    <select name ="required" class="form-control">
                            <option value="true"  selected>必須項目</option>
                            <option value="false">任意項目</option>
                    </select>
                </div>

                <div>
                    <label for="name">質問形式</label>                
                    <select name ="data_type_id" class="form-control">
                            <option value="1" selected>文字入力</option>
                            <option value="2">数字入力</option>
                            <option value="3">文章入力</option>
                            <option value="4">選択式</option>
                    </select>
                </div>

                <div>
                    <label for="name">選択式A</label> 
                    <p>複数選択しは、カンマ区切りで記入して下さい</p>               
                    <input type="text" id="" name="choices">
                </div>

                    <button type="submit" class="btn">
                        追加する
                    </button>
                </form>
            </div>

    </x-slot>
</x-app-layout>
