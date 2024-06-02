<?php

namespace App\Enums;

use App\Enums\Traits\Enum;

enum IdentityStatus : string
{
    use Enum;

    case Processing = 'processing';

    case Accepted = 'accepted';

    case Rejected = 'rejected';
}
