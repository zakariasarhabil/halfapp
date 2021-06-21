<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $fillable = [
        'name_office','mobile', 'email', 'name_account', 'bouquet'
    ];
}
