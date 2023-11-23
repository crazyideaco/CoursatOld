<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentWay extends Model
{
    use HasFactory;
    protected $fillable = [
        "title","number","creator_id","center_id",'image',
    ];
    protected $table = "payment_ways";

    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? asset($this->image) : '';
    }

    public function creator () {
        return $this->belongsTo(User::class,"creator_id");
    }

    public function center () {
        return $this->belongsTo(User::class,"center_id");
    }

}
