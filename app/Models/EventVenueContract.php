<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventVenueContract extends Model
{
    public $timestamps = false;
//    use HasFactory;

    public function event()
    {
        return $this->belongsTo(Event::class, 'EventID');
    }
}
