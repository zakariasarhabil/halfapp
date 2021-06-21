<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class OfficeOwner extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'expired_at', 'mobile_token'
    ];

    public function marketer() {
        return $this->hasMany('App\Marketer' , 'office_owners_id');
    }

    public function realstate() {
        return $this->hasMany('App\RealState' , 'office_owners_id');
    }

    public function request() {
        return $this->hasMany('App\Request' , 'office_owners_id');
    }


    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function(OfficeOwner $office){
    //         $office->marketer()->delete();
    //     });

    //     static::deleting(function(OfficeOwner $office){
    //         $office->realstate()->delete();
    //     });

    // }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
