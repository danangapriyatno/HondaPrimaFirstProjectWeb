<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountOtrVehicle extends Model
{
     protected $fillable = [
        'id', 'discount', 'otr','vehicles_id'
    ];
}
