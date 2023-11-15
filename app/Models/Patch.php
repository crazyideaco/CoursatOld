<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Patch extends Model
{
    use HasFactory;

    protected $table = 'patches';
    protected $guarded = [];

    public function createable(): MorphTo
    {
        return $this->morphTo();
    }

}
