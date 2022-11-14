<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Sanctum\HasApiTokens;

class TravelPayment extends Model
{
    use HasApiTokens, HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'travel_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * Get the user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Payment Approvals
     *
     * @return MorphMany
     */
    public function paymentApprovals(): MorphMany
    {
        return $this->morphMany('App\Models\PaymentApproval', 'payment');
    }
}
