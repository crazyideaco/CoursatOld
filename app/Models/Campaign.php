<?php

namespace App\Models;

use App\College;
use App\University;
use App\Year;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = ["title", "description", "start_date", "end_date", "category_id","college_id","university_id","stage_id","year_id"];
    protected $table = "campaigns";

    public function Platforms()
    {
        return $this->belongsToMany(Platform::class,"campaign_platform","campaign_id","platform_id");
    }

    public function college () {
        return $this->belongsTo(College::class);
    }
    public function university () {
        return $this->belongsTo(University::class);
    }
    public function stage () {
        return $this->belongsTo(Stage::class);
    }
    public function year () {
        return $this->belongsTo(Year::class);
    }
}
