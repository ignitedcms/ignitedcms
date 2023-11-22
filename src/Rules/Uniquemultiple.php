<?php
/*
|---------------------------------------------------------------
| Custom validation rule
|---------------------------------------------------------------
|
| Make sure all multiple routes are unique
| E.g blogs/intro, blogs/intro is a duplicate
| so throw an error
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

namespace Ignitedcms\Ignitedcms\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class Uniquemultiple implements ValidationRule
{
    public $sectionname;

    public function __construct($sectionname)
    {
        $this->sectionname = $sectionname;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tmp_route = $this->sectionname.'/'.$value;
        $rows = DB::table('routes')
            ->select('*')
            ->where('route', '=', $tmp_route)
            ->get();
        if ($rows->count() > 0) {
            $fail("The :attribute can not be a duplicate of $this->sectionname ");
        }

    }
}
