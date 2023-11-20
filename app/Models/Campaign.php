<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = ["title", "description", "start_date", "end_date", "target"];
    protected $table = "campaigns";

    public function Platforms()
    {
        return $this->belongsToMany(Platform::class,"campaign_platform","campaign_id","platform_id");
    }
}
