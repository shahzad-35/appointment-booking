<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['industry_id', 'owner_id', 'name', 'description', 'price'];

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
