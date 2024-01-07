<?php    
/*                                                                          
|---------------------------------------------------------------            
| Global helper functions
|---------------------------------------------------------------            
|
| Used in various files controllers and views
|
*/       
use Illuminate\Support\Facades\DB;

if (!function_exists('validSelect')) {
    function validSelect($array) {

        $ar = [];
        foreach ($array as $var) {
            array_push($ar, $var->option);
        }

        $a = self::noDuplicates($ar);
        $b = self::validVariableNames($ar);
        if ($a && $b) {
            return true;
        } else {
            return false;
        }
    }
}
