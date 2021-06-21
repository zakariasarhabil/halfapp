<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'name_client', 'number', 'type_realstate' , 'type_request' , 'space_min' , 'space_max' , 'price_min' , 'price_max' , 'information' ,'status' , 'office_owners_id' , 'marketers_id'
    ];

    public function office() {
        return $this->belongsTo('App\OfficeOwner', 'office_owners_id');
    }

    public function marketer() {
        return $this->belongsTo('App\Marketer', 'marketers_id');
    }
}
