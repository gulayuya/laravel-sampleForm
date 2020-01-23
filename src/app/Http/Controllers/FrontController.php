<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function index()
    {
        $items = \DB::table('ages')->get();

        return view('front/index', [
            'items' => $items,
        ]);
    }

    public function confirm(Request $request)
    {
        // フォームからの情報を取得
        $fullname = $request->input('fullname');
        $sex = $request->input('sex');
        $age = $request->input('age');
        $mail = $request->input('mail');
        $sentmail = $request->input('sentmail');
        $comment = $request->input('comment');

        // バリデーションチェック
        $validatedData = $request->validate([
            'fullname' => 'required',
            'age'      => 'required',
            'mail'     => 'required',
            'comment'  => 'max:1000',
        ]);

        // 確認ページを返す
        return view('front/confirm', [
            'fullname' => $fullname,
            'sex' => $sex,
            'age' => $age,
            'mail' => $mail,
            'sentmail' => $sentmail,
            'comment' => $comment,
        ]);
    }

    public function regist(Request $request)
    {
        // 再入力が押された場合の処理
        if ($request->get('action') === 'back') {
            // 入力画面へ戻る
            return redirect()
                ->route('index')
                ->withInput($request->all());
        }

        // DBに登録するデータを取得
        $fullname = $request->input('fullname');
        $sex = $request->input('sex');
        if ($sex === 'male') {
            $sex = 0;
        } else {
            $sex = 1;
        }
        $age = (int)$request->input('age');
        $mail = $request->input('mail');
        $sentmail = (int)$request->input('sentmail');
        $comment = $request->input('comment');
        $created_at = Carbon::now();

        // バリデーションチェック
        $validatedData = $request->validate([
            'fullname' => 'required',
            'age'      => 'required',
            'mail'     => 'required',
            'comment'  => 'max:1000',
        ]);

        \DB::table('answers')->insert([
            'fullname'        => $fullname,
            'gender'          => $sex,
            'age_id'          => $age,
            'email'           => $mail,
            'is_send_email'   => $sentmail,
            'feedback'        => $comment,
            'created_at'      => $created_at,
        ]);

        // トップへ戻る
        $items = \DB::table('ages')->get();

        return redirect()->route('index')->with('message', 'correct');
        
    }
}
