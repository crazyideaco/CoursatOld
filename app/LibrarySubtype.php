<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subtype;
class LibrarySubtype extends Model
{
     protected  $guarded = [];
      protected $table = "library_subtypes";
  public function subtype(){
    return $this->belongsTo(Subtype::class,'subtype_id');
  }
}