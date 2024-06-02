<?php

namespace App\Traits;

use App\Models\Setup\Identity;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait CanVerifyIdentity
{
    public function canVerifyID(): true
    {
        return true;
    }

    public function hasVerifiedID(): bool
    {
        return $this->id_verified_at != null;
    }

    public function identity(): MorphOne
    {
        return $this->morphOne(Identity::class, 'identifiable');
    }

    public function storeID(string $path): void
    {
        $class = new \ReflectionClass($this);

        $attrs = [
            'identifiable_type' => $class->getNamespaceName(),
            'identifiable_id' => $this->id,
            'id_path' => $path,
            'status' => 'processing'
        ];

        $id = new Identity($attrs);

        $id->save();
    }
}
