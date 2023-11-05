<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paqa_User extends Model
{
protected  $guarded = [];    
      protected $table = 'paqas_users';
      public function user()
    {
        return $this->belongsTo('App\User');
    }
      public function paqa()
    {
        return $this->belongsTo('App\Paqa');
    }
}
