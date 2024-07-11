<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomSize extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'price',
    ];

    // Relasi dengan tabel categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getSizeRangeAttribute()
    {
        return "{$this->min_size} - {$this->max_size} meters";
    }
}
