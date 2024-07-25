<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
       'name', 'username','email','password', 'role',
    ];

    protected $hidden = [
        'password',
    ];
    public function generatePasswordResetToken()
    {
        $this->reset_password_token = Str::random(60);
        $this->token_created_at = now();
        $this->save();
    }

    public function clearPasswordResetToken()
    {
        $this->reset_password_token = null;
        $this->token_created_at = null;
        $this->save();
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
