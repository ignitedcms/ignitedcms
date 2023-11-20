<?php

namespace Ignitedcms\Ignitedcms\Http\Controllers;

use App\Http\Controllers\Controller;

class  ContactController extends Controller
{

    public function index()
    {
        return view('ignitedcms::contact');
    }
}