<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'TicketID';

    public function purchase()
    {
        return $this->belongsToMany(Purchase::class);
    }

    public function event(){

        return $this->belongsTo(Event::class);
    }
}

