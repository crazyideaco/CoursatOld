<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentWay extends Model
{
    use HasFactory;
    protected $fillable = [
        "title","number","creator_id","center_id"
    ];
    protected $table = "payment_ways";
    public function creator () {
        return $this->belongsTo(User::class,"creator_id");
    }

    public function center () {
        return $this->belongsTo(User::class,"center_id");
    }

}
