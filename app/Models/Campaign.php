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
    protected $fillable = ["title", "description", "start_date", "end_date", "category_id", "college_id", "university_id", "stage_id", "year_id"];
    protected $table = "campaigns";

    /**
     * Retrieve the platforms associated with this entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Platforms()
    {
        return $this->belongsToMany(Platform::class, "campaign_platform", "campaign_id", "platform_id");
    }

    /**
     * Retrieves the college that this belongs to.
     *
     * @return College
     */
    public function college()
    {
        return $this->belongsTo(College::class);
    }

    /**
     * Retrieves the university associated with this instance.
     *
     * @return University The university associated with this instance.
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Retrieves the related Stage model for this instance.
     *
     * @return Stage The related Stage model.
     */
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    /**
     * Retrieves the associated Year model for this object.
     *
     * @return Year The associated Year model.
     */
    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
