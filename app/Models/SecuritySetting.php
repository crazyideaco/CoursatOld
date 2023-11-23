<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SecuritySetting extends Model
{
    use HasFactory;

    protected $table = 'security_settings';
    protected $guarded = [];

    public function typeable(): MorphTo
    {
        return $this->morphTo();
    }

    
}
