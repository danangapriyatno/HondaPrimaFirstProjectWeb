<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerTerm extends Model
{
         /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
         						
    protected $fillable = [
        'id', 'nik', 'name','telephone','customer_id','city'
    ];

      public function customertermcustomer()
	{
    	return $this->belongsTo('App\Customer','customer_id','id');
	}
}
