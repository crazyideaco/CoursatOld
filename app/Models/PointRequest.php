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
use App\User;
use Carbon\Carbon;

class PointRequest extends Model
{
    protected  $guarded = [];
    protected $table = "point_requests";

    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? asset($this->image) : '';
    }

    public function user()
    {
        return $this->belongsto(User::class, 'user_id');
    }
    public function payment_way()
    {
        return $this->belongsto(PaymentWay::class, 'payment_way_id');
    }
    public function getDateFormatAttribute(){
        return Carbon::parse($this->created_at)->format('Y-m-d g:i A') ;
    }
}
