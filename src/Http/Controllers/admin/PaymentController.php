<?php
/*
|---------------------------------------------------------------
| Payment controller
|---------------------------------------------------------------
|
| Depends on Laravel cashier and custom Paypal IPN setup
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':19');
    }

    public function index()
    {
        $data = '';

        return view('ignitedcms::admin.payments.index')->with([
            'data' => $data,
        ]);
    }
}
