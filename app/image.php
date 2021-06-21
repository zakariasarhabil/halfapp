<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $fillable = [
        'path','image_url', 'name' ,'real_states_id'
  ];
  protected $hidden = [
    'path'
];
  public function realstate()
  {
      return $this->belongsTo('App\RealState', 'real_states_id');
  }
}
