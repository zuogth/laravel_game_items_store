<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        return view('user.home', [
            'title' => 'Admin'
        ]);
    }
}
