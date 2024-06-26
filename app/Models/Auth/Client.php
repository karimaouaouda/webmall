<?php

namespace App\Models\Auth;

use App\Models\Address;
use App\Models\Client\Cart;
use App\Models\Client\Command;
use App\Models\Client\Interest;
use App\Models\Message;
use App\Models\Setup\SubCategory;
use App\Models\Shop;
use App\Observers\ClientObserver;
use App\Traits\HasAddress;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Karimaouaouda\LaravelRater\Traits\CanRate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

#[ObservedBy([ClientObserver::class])]
class Client extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use CanRate;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasAddress;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'google_token',
        'google_refresh_tokent',
        'facebook_id',
        'facebook_token',
        'facebook_refresh_tokent',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }


    public function commands(): HasMany
    {
        return $this->hasMany(Command::class);
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(Shop::class, 'shops_followers');
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'interests' );
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Shop\Product::class, 'favorites');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
