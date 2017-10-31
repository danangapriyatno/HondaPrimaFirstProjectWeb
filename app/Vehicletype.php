<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
                        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
       															  						
    protected $fillable = [
        'id', 'vehicles_name'
    ];

 	public function vehicletypevehicle()
    {
        return $this->hasMany('App\Vehicle');
    }
}
