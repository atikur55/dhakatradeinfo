<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceStation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function connect_country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function connect_state()
    {
        return $this->belongsTo(State::class,'state_id');
    }
}
