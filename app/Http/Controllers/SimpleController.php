<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * シンプルなメッセージ表示ページコントローラ
 */
class SimpleController extends Controller
{
    /**
     * GET表示
     */
    public function index()
    {
        return view('simple');
    }
}
