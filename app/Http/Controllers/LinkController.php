<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * リンクページコントローラ
 */
class LinkController extends Controller
{
    /**
     * GET表示
     */
    public function index()
    {
        return view('link');
    }
}
