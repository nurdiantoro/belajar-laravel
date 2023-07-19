<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard', ['request' => $request]);
    }

    public function user_detail(Request $request)
    {
        return view('user_detail', ['request' => $request]);
    }
}
