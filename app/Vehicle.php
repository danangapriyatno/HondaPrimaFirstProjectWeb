<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */			
    protected $fillable = [
        'id', 'code_stock','name','colour','frame_no','machine_no','stock','customer_id','vehicles_type_id'
    ];

      public function vehiclecustomer()
	{
    	return $this->belongsTo('App\Customer','customer_id','type_id');
	}

     public function vehicletypevehicle()
    {
        return $this->belongsTo('App\Vehicletype','vehicles_type_id','id');
    }
}
