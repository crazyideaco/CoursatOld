<?php

namespace App\Models;

use App\Category;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reel extends Model
{
    use HasFactory;

    protected $table = 'reels';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function informations()
    {
        return $this->hasMany(ReelInformation::class);
    }

    public function information(): HasOne
    {
        return $this->hasOne(ReelInformation::class, 'reel_id');
    }

    protected $appends = ['date_format'];

    public function getDateFormatAttribute(){
        return Carbon::parse($this->created_at)->format('Y-m-d g:i A') ;
    }
}
