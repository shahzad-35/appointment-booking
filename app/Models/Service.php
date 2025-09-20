<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['industry_id', 'owner_id', 'name', 'description', 'price'];

    public static function getServicesByOwnerId(int $ownerId): Collection
    {
        return self::where('owner_id', $ownerId)->get();
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}
