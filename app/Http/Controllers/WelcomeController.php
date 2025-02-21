<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function post(Request $request)
    {
        $name = $request->get('name');
        return view('show', ['name' => $name]);
    }
}
