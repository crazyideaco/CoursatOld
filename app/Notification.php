<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Booking_name;
use App\Booking_type;
class Notification extends Model
{
    protected $guraded = [];
    protected $table = 'notifications';
}
