<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Answer;

class AnswerController extends Controller
{
    public function index()
    {
        // answersレコードの一覧を取得して表示する（/answer/index）

        $items = DB::table('answers')->paginate(15);
        $count = DB::table('answers')->count();

        return view('front/answer', [
            'items' => $items,
            'count' => $count,
        ]);
    }

    public function memo(Request $request)
    {
        $sName = $request->sName;
        $sAge = $request->sAge;
        $sGender = $request->sGender;
        $sDateStart = $request->sDateStart;
        $sDateEnd = $request->sDateEnd;
        $sSendMail = $request->sSendMail;
        $sKeyword = $request->sKeyword;

        return view('front/memo', [
            'sName' => $sName,
            'sAge' => $sAge,
            'sGender' => $sGender,
            'sDateStart' => $sDateStart,
            'sDateEnd' => $sDateEnd,
            'sSendMail' => $sSendMail,
            'sKeyword' => $sKeyword,
        ]);
    }

    public function search(Request $request)
    {
        // 値を取得
        $sName = $request->sName;
        $sAge = (int)$request->sAge;
        $sGender = (int)$request->sGender;
        $sDateStart = $request->sDateStart;
        $sDateEnd = $request->sDateEnd;
        $sSendMail = (int)$request->sSendMail;
        $sKeyword = $request->sKeyword;

        $query = Answer::query();

        if (!empty($sName)) {
            $query->where('fullname', 'like', '%'.$sName.'%');
        }

        if (!empty($sAge)) {
            $query->where('age_id', $sAge);
        }

        if (!empty($sGender)) {

            if ($sGender > 2) {
                $query->whereBetween('gender', [1, 2]);
            } else {
                $query->where('gender', $sGender);
            }
        }

        // 日付検索
        if (!empty($sDateStart) || !empty($sDateEnd)) {
            if (!empty($sDateStart) && empty($sDateEnd)) {
                $query->whereDate('created_at', '>', $sDateStart);
            } elseif (empty($sDateStart) && !empty($sDateEnd)) {
                $query->whereDate('created_at', '<', $sDateEnd);
            } else {
                $query->whereDate('created_at', '>', $sDateStart)
                ->whereDate('created_at', '<', $sDateEnd);
            }
        }

        if (!empty($sSendMail)) {
            $query->where('is_send_email', $sSendMail);
        }

        if (!empty($sKeyword)) {
            $query->where('feedback', 'like', '%'.$sKeyword.'%')
            ->orWhere('email', 'like', '%'.$sKeyword.'%');
        }

        $results = $query->get();

        $items = DB::table('answers')->paginate(15);
        $count = DB::table('answers')->count();

        return view('front/answer', [
            'items' => $items,
            'count' => $count,
            'results' => $results,
        ]);
    }

    public function show(Answer $answer) {

        $items = DB::table('answers')->find($answer->id);

        return view('front/answerShow', [
            'items' => $items,
        ]);
    }

    public function delete(Request $request) {
        // 再入力が押された場合の処理
        if ($request->get('action') === 'back') {

            // 入力画面へ戻る
            return redirect()
                ->route('answers.index')
                ->withInput($request->all());

            // 入力画面へ戻る際に前回の検索結果を表示させるには
        }

        $id = $request->id;
        $query = DB::table('answers')->where('id', $id);
        $target = $query->first();
        $query->delete();

        $flag = 1;
        $items = DB::table('answers')->paginate(15);
        $count = DB::table('answers')->count();

        return view('front/answer', [
            'flag' => $flag,
            'items' => $items,
            'count' => $count,
        ]);
    }
}
