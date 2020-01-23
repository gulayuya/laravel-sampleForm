@extends('front/layouts.app')

@section('content')
    <h1>内容確認</h1>
    <form action="/regist" method="post">
        @csrf
        <div class="item">
            <label class="label">氏名<span>※</span></label>
            <label class="inputs">{{ $fullname }}</label>
            <input type="hidden" name="fullname" value="{{ $fullname }}">
        </div>
        <div class="item">
            <label class="label">性別<span>※</span></label>
            @if ($sex === 'male')
                <label class="inputs" name="sex" value="1">男性</label>
            @else
                <label class="inputs" name="sex" value="2">女性</label>
            @endif
            <input type="hidden" name="sex" value="{{ $sex }}">
        </div>
        <div class="item">
            <label class="label">年代<span>※</span></label>
            @switch ($age)
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
            <input type="hidden" name="age" value="{{ $age }}">
        </div>
        <div class="item">
            <label class="label">メールアドレス<span>※</span></label>
            <label class="inputs">{{ $mail }}</label>
            <input type="hidden" name="mail" value="{{ $mail }}">
        </div>
        <div class="item">
            <label class="label">メール送信可否</label>
            @if ($sentmail === 'allow')
                <label class="inputs">送信許可</label>
                <input type="hidden" name="sentmail" value="1">
            @else
                <label class="inputs">非許可</label>
                <input type="hidden" name="sentmail" value="2">
            @endif
        </div>
        <div class="item">
            <label class="label">ご意見</label>
            <label class="inputs">{!! nl2br(e($comment), false) !!}</label>
            <input type="hidden" name="comment" value="{{ $comment }}">
        </div>
        <div class="btn-area">
            <button type="submit" name="action" value="back">再入力</button>
            <button type="submit" name="action" value="post">送信</button>
        </div>
    </form>
@endsection