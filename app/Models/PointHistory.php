<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\City;
use App\Users;
use App\Category;
use App\Models\PaymentWay;

class PointHistory extends Model
{
    protected  $guarded = [];
    protected $table = "point_histories";
    public function user()
    {
        return $this->belongsto(User::class, 'user_id');
    }

    protected $appends = ['type_format'];

    public function getTypeFormatAttribute()
    {
        if ($this->type == 1) {
            return 'شراء';
        }

    }
}
