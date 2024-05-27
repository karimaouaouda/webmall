<?php

namespace App\Enums;

use App\Enums\Traits\Enum;

enum ShippingStatus : string
{
    use Enum;
    case Processing = 'processing';

    case Shipped = 'shipped';

    case Finished = 'finished';


}
