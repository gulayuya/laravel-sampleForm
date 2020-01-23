@extends('front/layouts.app')

@section('content')
    @if (Session::has('message'))
        <p style="color: skyblue;">登録が完了しました</p>
    @endif
    <h1>システムへのご意見をお聞かせください</h1>
    <form action="/confirm" method="post">
        @csrf
        <div class="item">
            <label class="label">氏名<span>※</span></label>
            <input class="inputs" type="text" name="fullname" placeholder="入力してください" value="{{ old('fullname') }}">
        </div>
        @error('fullname')
            @include('front/error')
        @enderror
        <div class="item">
            <label class="label">性別<span>※</span></label>
            <div class="inputs">
                @if (old('sex') === 'male')
                    <input type="radio" id ="male" name="sex" value="male" checked="checked">
                    <label for="male">男性</label>
                    <input type="radio" id ="female" name="sex" value="female">
                    <label for="female">女性</label>
                @elseif (old('sex') === 'female')
                    <input type="radio" id ="male" name="sex" value="male">
                    <label for="male">男性</label>
                    <input type="radio" id ="female" name="sex" value="female" checked="checked">
                    <label for="female">女性</label>
                @else
                    <input type="radio" id ="male" name="sex" value="male" checked="checked">
                    <label for="male">男性</label>
                    <input type="radio" id ="female" name="sex" value="female">
                    <label for="female">女性</label>
                @endif
            </div>
        </div>
        <div class="item">
            <label class="label">年代<span>※</span></label>
            <select name="age" class="inputs">
                @if (old('age'))
                    @foreach ($items as $item)
                        @if ($item->id == old('age'))
                            <option value="{{ $item->id }}" selected>{{ $item->age }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->age }}</option>
                        @endif
                    @endforeach
                @else
                    <option value="" style="display: none;">選択してください</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->age }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        @error('age')
            @include('front/error')
        @enderror
        <div class="item">
            <label class="label">メールアドレス<span>※</span></label>
            <input type="text" name="mail" class="inputs" placeholder="入力してください" value="{{ old('mail') }}">
        </div>
        @error('mail')
            @include('front/error')
        @enderror
        <div class="item">
            <label class="label">メール送信可否</label>
            <div class="inputs">
                <p>登録したメールアドレスにメールマガジンをお送りしてもよろしいですか？</p>
                @if (old('sentmail'))
                    @if (old('sentmail') == 1)
                        <input type="checkbox" id="allow" name="sentmail" value="allow"><label for="allow">送信を許可します</label>
                    @else
                        <input type="checkbox" id="allow" name="sentmail" value="allow" checked="checked"><label for="allow">送信を許可します</label>
                    @endif
                @else
                    <input type="checkbox" id="allow" name="sentmail" value="allow" checked="checked"><label for="allow">送信を許可します</label>
                @endif
            </div>
        </div>
        <div class="item">
            <label class="label">ご意見</label>
            <textarea class="inputs" name="comment" placeholder="入力してください">{{ old('comment') }}</textarea>
        </div>
        @error('comment')
            @include('front/error')
        @enderror
        <div class="btn-area">
            <input type="submit" value="確認">
        </div>
    </form>
@endsection