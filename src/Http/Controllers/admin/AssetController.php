<?php
/*
|---------------------------------------------------------------
| Asset controller
|---------------------------------------------------------------
|
| All logic for uploading assets
| Need to look and gumlet for image resizing
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;

use Gumlet\ImageResize;

class AssetController extends Controller
{
   public function __construct() 
   {
      $this->middleware(Igs_auth::class);
   }

   public function index()
   {
      echo ("boo");

   }
}
