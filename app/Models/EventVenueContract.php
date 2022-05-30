<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventVenueContract extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ContractID';
//    use HasFactory;

    public function venues()
    {
        return $this->belongsTo(Venue::class, 'venue_contract');
    }
}
