@extends('front/layouts.app')

@section('content')
    <h1>アンケート詳細</h1>
    <form action="/delete" method="post">
        @csrf
        <div class="item">
            <label class="label">ID</label>
            <label class="inputs">{{ $items->id }}</label>
            <input type="hidden" name="id" value="{{ $items->id }}">
        </div>
        <div class="item">
            <label class="label">氏名</label>
            <label class="inputs">{{ $items->fullname }}</label>
            <input type="hidden" name="fullname" value="{{ $items->fullname }}">
        </div>
        <div class="item">
            <label class="label">性別</label>
            @if ($items->gender == '1')
                <label class="inputs" name="sex" value="1">男性</label>
            @else
                <label class="inputs" name="sex" value="2">女性</label>
            @endif
            <input type="hidden" name="sex" value="{{ $items->gender }}">
        </div>
        <div class="item">
            <label class="label">年代</label>
            @switch ($items->age_id)
                @case(1)
                    <label class="inputs">10代以下</label>
                    @break
                @case(2)
                    <label class="inputs">20代</label>
                    @break
                @case(3)
                    <label class="inputs">30代</label>
                    @break
                @case(4)
                    <label class="inputs">40代</label>
                    @break
                @case(5)
                    <label class="inputs">50代</label>
                    @break
                @case(6)
                    <label class="inputs">60代以上</label>
                    @break
            @endswitch
            <input type="hidden" name="age" value="{{ $items->age_id }}">
        </div>
        <div class="item">
            <label class="label">メールアドレス</label>
            <label class="inputs">{{ $items->email }}</label>
            <input type="hidden" name="mail" value="{{ $items->email }}">
        </div>
        <div class="item">
            <label class="label">メール送信可否</label>
            @if ($items->is_send_email == '1')
                <label class="inputs">送信許可</label>
                <input type="hidden" name="sentmail" value="1">
            @else
                <label class="inputs">非許可</label>
                <input type="hidden" name="sentmail" value="2">
            @endif
        </div>
        <div class="item">
            <label class="label">ご意見</label>
            <label class="inputs">{!! nl2br(e($items->feedback), false) !!}</label>
            <input type="hidden" name="comment" value="{{ $items->feedback }}">
        </div>
        <div class="item">
            <label class="label">登録日時</label>
            <label class="inputs">{{ $items->created_at }}</label>
            <input type="hidden" name="created_at" value="{{ $items->created_at }}">
        </div>
        <div class="btn-area">
            <button type="submit" name="action" value="back">一覧に戻る</button>
            <button type="submit" name="action" value="delete">削除</button>
        </div>
    </form>
@endsection