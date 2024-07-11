<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'user_id',
        'room_size_id',
        'address',
        'phone',
        'booking_date',
        'payment_method_id',
        'payment_proof', 
        'status', 
        'booking_code',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roomSize()
    {
        return $this->belongsTo(RoomSize::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
