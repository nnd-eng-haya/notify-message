<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 他ページコントローラ
 */
class OtherController extends Controller
{
    /**
     * GET表示
     */
    public function index()
    {
        return view('other');
    }
}
