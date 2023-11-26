<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentWay extends Model
{
    use HasFactory;
    protected $fillable = [
        "title", "number", "creator_id", "center_id", 'image',
    ];
    protected $table = "payment_ways";

    protected $appends  = ["image_link"];

    /**
     * Returns the image link attribute of the object.
     *
     * @return string The image link or an empty string if no image is set.
     */
    public function getImageLinkAttribute()
    {
        return $this->image ? asset($this->image) : '';
    }

    /**
     * Retrieve the User model that created this instance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, "creator_id");
    }

    /**
     * Retrieve the User model that this belongs to.
     *
     * @param string $relation The name of the relationship
     * @param string|null $foreignKey The foreign key column
     * @param string|null $ownerKey The owner key column
     * @return \App\Models\User
     */
    public function center()
    {
        return $this->belongsTo(User::class, "center_id");
    }

    /**
     * Retrieves the centers associated with the payment way.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function centers()
    {
        return $this->belongsToMany(User::class, "centers_paymentway", "paymentway_id", "center_id");
    }
}
