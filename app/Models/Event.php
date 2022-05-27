<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model{
    protected $primaryKey = 'EventID';

    public function eventVenueContract()
    {
        return $this->hasOne(EventVenueContract::class, 'EventID');
    }

    public function eventOrganizer()
    {
        return $this->belongsTo(EventOrganizer::class);
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'EventID');
    }
}
