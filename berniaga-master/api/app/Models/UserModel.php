<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class UserModel extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $guard = 'user';
    protected $table= 'user';

    protected $fillable = [
        'name', 'email', 'password', 'gender', 'no_telp', 'date_of_birth'
    ];

    protected $hidden = [
        'password',
    ];

}
