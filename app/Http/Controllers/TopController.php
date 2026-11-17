<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * トップページコントローラ
 */
class TopController extends Controller
{
    /**
     * GET表示
     */
    public function index()
    {
        return view('top');
    }

    /**
     * POST更新
     * @param   Request $request    リクエスト
     */
    public function update(Request $request)
    {
        $type = $request->type;

        // 以下2パターンのセッションメッセージ送信
        // components/message.blade.phpと合わせる

        ////////////////////////////////
        // [1]パラメータをバラで送る
        ////////////////////////////////
        // // セッションメッセージ
        // session()->flash($type, "{$type}のセッションメッセージ");
        // // セッションは配列送れないのでJSON文字列で渡す
        // session()->flash('link', json_encode(['url' => route('link'), 'text' => "リンクをクリック"]));
        // // session()->flash('duration', 3000);

        ////////////////////////////////
        // [2]パラメータをまとめてJSONで送る
        ////////////////////////////////
        $parameters = [
            "messageType" => $type,
            "message" => "{$type}のセッションメッセージ",
            "link" => ['url' => route('link'), 'text' => "リンクをクリック"],
            "duration" => 3000,
        ];
        session()->flash("message", json_encode($parameters));

        return redirect()->route('other');
    }
}
