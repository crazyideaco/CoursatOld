<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qr_codes';
    protected $guarded = [];

    public function typeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function patch():BelongsTo
    {
        return $this->belongsTo(Patch::class);
    }

    protected $appends = ['date_format','expire_date_format','status_format'];

    public function getDateFormatAttribute(){
        return Carbon::parse($this->created_at)->format('Y-m-d g:i A') ;
    }

    public function getExpireDateFormatAttribute(){
        return Carbon::parse($this->expire_date)->format('Y-m-d') ;
    }

    public function getStatusFormatAttribute(){
        if($this->status == 0){
            return 'available';
        }
        elseif($this->status == 1 || $this->expire_date < Carbon::now()){
            return 'expired';

        }elseif($this->status == 2){
            return 'used';
        }
    }
}
