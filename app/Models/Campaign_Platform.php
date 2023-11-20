<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign_Platform extends Model
{
    use HasFactory;
    protected $fillable = ["campaign_id","platform_id"];
    protected $table = "campaign_platform";
}
