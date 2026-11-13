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

        // セッションメッセージ
        session()->flash($type, "{$type}のセッションメッセージ");
        session()->flash('linkUrl', route('link'));
        session()->flash("linkText", "リンクをクリック");
        session()->flash('duration', 3000);

        return redirect()->route('other');
    }
}
