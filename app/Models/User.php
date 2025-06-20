<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $collection = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_key',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'api_key',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
/*             'email_verified_at' => 'datetime', */
            'password' => 'hashed',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->api_key = bin2hex(random_bytes(32));

            $freePlan = Plan::where('name', 'Gratuito')->first();
            if ($freePlan) {
                $user->plan_id = $freePlan->_id;
            }
        });
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function markEmailAsVerified(): bool
    {
        $this->email_verified_at = now();
        return $this->save();
    }

    public function hasVerifiedEmail(): bool
{
    return !is_null($this->email_verified_at);
}

}
