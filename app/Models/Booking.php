<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $table = 'bookings';
    public const BOOKING_STATUS_PENDING = 'pending';
    public const BOOKING_STATUS_RESCHEDULED = 'rescheduled';
    public const BOOKING_STATUS_CONFIRMED = 'confirmed';
    public const BOOKING_STATUS_CANCELLED = 'cancelled';


    protected $fillable = ['slot_id', 'user_id', 'status', 'updated_at'];

    public static function getBookingStatusesArray(): array
    {
        return [
            'pending' => ucfirst(self::BOOKING_STATUS_PENDING),
            'rescheduled' => ucfirst(self::BOOKING_STATUS_RESCHEDULED),
            'confirmed' => ucfirst(self::BOOKING_STATUS_CONFIRMED),
            'cancelled' => ucfirst(self::BOOKING_STATUS_CANCELLED),
        ];
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
