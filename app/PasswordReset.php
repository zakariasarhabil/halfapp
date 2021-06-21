<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'email', 'token'
    ];
}
