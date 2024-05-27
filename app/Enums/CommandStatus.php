<?php

namespace App\Enums;

use App\Enums\Traits\Enum;

enum CommandStatus: string
{
    use Enum;
    case Processing = 'processing';

    case Shipped = 'shipped';

    case Finished = 'finished';





}
