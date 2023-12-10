<?php
/*
|---------------------------------------------------------------
| Route model
|
| Maps the routes to friendly urls
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Models\admin;

use Ignitedcms\Ignitedcms\Http\Controllers\admin\ParserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Router
{
    public static function getRoutes()
    {
        $routes = DB::table('routes')
            ->select('*')
            ->get();

        $data = [];
        foreach ($routes as $route) {
            $string = Str::of($route->controller)
                ->replaceStart('admin/parser/', '')->toString();

            if (str::startsWith($string, 'display')) {

                $arr = explode('/', $string);

                Route::get($route->route, [ParserController::class, 'display'])
                    ->defaults('sid', $arr[1])->defaults('eid', $arr[2]);

            }
            //else it is a multiple index
            else {
                $arr2 = explode('/', $string);
                Route::get($route->route, [ParserController::class, 'index_page'])
                    ->defaults('sectionname', $arr2[1]);

            }

        }
    }
}
