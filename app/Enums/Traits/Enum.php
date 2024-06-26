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


    public static function assoc(): array
    {
        $arr = [];

        foreach (self::values() as $value){
            $arr[$value] = $value;
        }

        return $arr;
    }
}
