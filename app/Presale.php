<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presale extends Model
{
                 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
       										  						
    protected $fillable = [
        'id', 'payment', 'otr','down_payment','discount','leasing','installment','tenor','program','presales_no','vehicle_id','customer_id'
    ];

     public function presalecustomer()
	{
    	return $this->belongsTo('App\Customer','id','customer_id');
	}
     public function presalecustomerupload()
    {
        return $this->hasMany('App\Presaleupload');
    }

}
