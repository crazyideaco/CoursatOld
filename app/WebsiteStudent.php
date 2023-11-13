<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class WebsiteStudent extends Authenticatable
{
    use Notifiable;
    protected  $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];
public function user(){
    return $this->belongsTo(User::class);
}
   
    public function courses(){
        return $this->hasMany(WebsiteStudentCourse::class);
    }
}
