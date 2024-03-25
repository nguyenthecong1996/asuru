<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'email', 
        'password',
        'device_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
