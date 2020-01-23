<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/answer-style.css') }}">
    <script src="{{ asset('js/app/js') }}"></script>
</head>
<body>
    <div class="answer-search">
        @isset($flag)
            <p>対象のアンケート結果を削除しました</p>
        @endisset
        <h2>検索フォーム</h2>
        <form action="/search" method="get">
            <label for="">氏名</label>
            <input type="text" name="sName" placeholder="入力してください">
            <label for="">年代</label>
            <select name="sAge">
                <option value="0">すべて</option>
                <option value="1">10代以下</option>
                <option value="2">20代</option>
                <option value="3">30代</option>
                <option value="4">40代</option>
                <option value="5">50代</option>
                <option value="6">60代以上</option>
            </select>
            <label for="">性別</label>
            <input type="radio" name="sGender" value="3">
            <label for="">すべて</label>
            <input type="radio" name="sGender" value="1">
            <label for="">男性</label>
            <input type="radio" name="sGender" value="2">
            <label for="">女性</label>
            <br>
            <label for="">登録日</label>
            <input type="text" name="sDateStart" placeholder="年/月/日"> ~ <input type="text" name="sDateEnd" placeholder="年/月/日">
            <label for="">メール送信許可</label>
            <input type="checkbox" name="sSendMail" value="1"><label for="">許可のみ</label>
            <br>
            <label for="">キーワード</label>
            <input type="text" name="sKeyword" placeholder="キーワードを入力">
            <br>
            <button type="submit" name="action" value="reset">リセット</button>
            <button type="submit" name="action" value="get">検索</button>
        </form>
    </div>
    <div class="showSearchResult" style="margin-bottom: 20px;">
        <h2>検索結果表示</h2>
        <table border="1" width="800" cellspacing="0" cellpadding="5" bordercolor="#333">
            <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>性別</th>
                <th>年代</th>
                <th>内容</th>
                <th></th>
            </tr>
            @isset ($results)
                @foreach ($results as $result)
                    <tr>
                        <th>{{ $result->id }}</th>
                        <th>{{ $result->fullname }}</th>
                        @if ($result->gender == 1)
                            <th>男性</th>
                        @else
                            <th>女性</th>
                        @endif
                        @switch ($result->age_id)
                            @case(1)
                                <th>10代以下</th>
                                @break
                            @case(2)
                                <th>20代</th>
                                @break
                            @case(3)
                                <th>30代</th>
                                @break
                            @case(4)
                                <th>40代</th>
                                @break
                            @case(5)
                                <th>50代</th>
                                @break
                            @case(6)
                                <th>60代以上</th>
                                @break
                        @endswitch
                        <th>{{ str_limit($result->feedback, 15, '  ...') }}</th>
                        <th>
                            <form action="/answers/{{ $result->id }}" method="get">
                                <!-- <input type="hidden" name="searchInfo" value="{{ request()->fullUrl() }}"> -->
                                <button>詳細</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
            @endisset
        </table>
        @if (!isset($results[0]))
            <p>該当するアンケートはありませんでした</p>
        @endif
    </div>
    <div class="answer-table">
        <h2>全データ表示</h2>
        <table border="1" width="800" cellspacing="0" cellpadding="5" bordercolor="#333">
            <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>性別</th>
                <th>年代</th>
                <th>内容</th>
                <th></th>
            </tr>
            @foreach ($items as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <th>{{ $item->fullname }}</th>
                    @if ($item->gender == 1)
                        <th>男性</th>
                    @else
                        <th>女性</th>
                    @endif
                    @switch ($item->age_id)
                        @case(1)
                            <th>10代以下</th>
                            @break
                        @case(2)
                            <th>20代</th>
                            @break
                        @case(3)
                            <th>30代</th>
                            @break
                        @case(4)
                            <th>40代</th>
                            @break
                        @case(5)
                            <th>50代</th>
                            @break
                        @case(6)
                            <th>60代以上</th>
                            @break
                    @endswitch
                    <th>{{ str_limit($item->feedback, 15, '  ...') }}</th>
                    <th><button onclick="location.href='/answers/{{ $item->id }}'">詳細</button></th>
                </tr>
            @endforeach
        </table>
        <p>全{{ $count }}件</p>
        <p>{{ $items->firstItem() }} ~ {{ $items->lastItem() }}件表示中</p>
        {{ $items->links() }}
        
    </div>
</body>
</html>


    
