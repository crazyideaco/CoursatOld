<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentwayCenter extends Model
{
    use HasFactory;
    protected $fillable = ["paymentway_id", "center_id"];
    protected $table = "centers_paymentway";
}
