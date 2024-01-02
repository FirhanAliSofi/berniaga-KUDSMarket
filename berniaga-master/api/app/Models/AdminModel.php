<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class AdminModel extends Model
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table= 'admin';
    protected $guard = 'admin';
    protected $fillable = [
        'nama', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
