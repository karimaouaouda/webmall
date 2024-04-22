<?php

namespace App\Enums;

enum ShippingStatus : string
{
    case Processing = 'processing';

    case Shipped = 'shipped';

    case Finished = 'finished';

    public static function values(){

        $values = [];
        foreach(self::cases() as $case){
            $values[] = $case->value;
        }


        return $values;
    }
}
