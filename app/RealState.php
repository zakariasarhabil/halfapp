<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealState extends Model
{
    protected $fillable = [
        'creator', 'type_offer', 'type_RealState', 'space', 'price', 'price_meter', 'facade', 'video', 'location', 'evaluation', 'age', 'number_apartment', 'furnished', 'duplex', 'driver_room', 'addition', 'cellar', 'elevator', 'magnifier', 'earth_type', 'annual_income', 'specification', 'number_offices', 'type_owner', 'name_owner','phone', 'phone_two' ,'Edited_by', 'office_owners_id'
    ];

    public function office() {
        return $this->belongsTo('App\OfficeOwner', 'office_owners_id');
    }

    public function image() {
        return $this->hasMany('App\image' , 'real_states_id');
    }


    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function(RealState $real){

    //         $real->image()->delete();
    //     });


    // }


}
