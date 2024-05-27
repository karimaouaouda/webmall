<?php

namespace App\Enums\Traits;

/**
 *
*/
trait Enum{

    public static function values(){

        $values = [];
        foreach(self::cases() as $case){
            $values[] = $case->value;
        }


        return $values;
    }
}
