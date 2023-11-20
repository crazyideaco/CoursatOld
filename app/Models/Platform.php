<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;
    protected $fillable = ["title", "url"];
    protected $table = "platforms";

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class,"campaign_platform","platform_id","campaign_id");
    }
}
