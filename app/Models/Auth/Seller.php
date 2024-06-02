<?php

namespace App\Models\Auth;

use App\Models\Address;
use App\Observers\SellerObserver;
use App\Traits\CanVerifyIdentity;
use App\Traits\HasAddress;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Shop;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Karimaouaouda\LaravelRater\Traits\CanRate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

#[ObservedBy([SellerObserver::class])]
class Seller extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use CanRate;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasAddress;
    use CanVerifyIdentity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id_verified_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //attributes

    public function getHasShopAttribute() : bool{
        return $this->shop != null;
    }

    //relations

    public function shop() : HasOne{
        return $this->hasOne(Shop::class);
    }

    //filament methods
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
