<?php
/**
 * Created by PhpStorm.
 * User: amigo
 * Date: 4/3/17
 * Time: 10:59 AM
 */

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Uni extends Facade{

    /**
     * @return string
     * 
     */
    protected static function getFacadeAccessor() {
        return 'uni';
    }
}