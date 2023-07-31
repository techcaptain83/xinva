<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Cashier\Billable;
use Laravel\Paddle\Billable;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Payment;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, Billable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'trial_ends_at',
        'total_credits',
        'credits_used',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
    public function socialProfiles()
    {
        return $this->hasMany(SocialProfile::class);
    }

    public function creditUsages()
    {
        return $this->hasMany(CreditUsage::class);
    }

    public function canAccessFilament(): bool
    {
        return $this->hasRole('admin');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function bgRemovedResults()
    {
        return $this->hasManyThrough(PredictionResult::class, Prediction::class);
    }
}
