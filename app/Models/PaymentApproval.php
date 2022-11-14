<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Sanctum\HasApiTokens;

class PaymentApproval extends Model
{
    use HasApiTokens, HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_approvals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'payment_type',
        'payment_id',
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
     * Get the concrete payment.
     *
     * @return MorphTo
     */
    public function payment(): MorphTo
    {
        return $this->morphTo();
    }
}
