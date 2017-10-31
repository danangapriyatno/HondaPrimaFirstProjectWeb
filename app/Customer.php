<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
					
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nik', 'name','telephone','city','type_id'
    ];

    public function customerpresales()
	{
    	return $this->hasMany('App\Presales');
	}
      public function customercustomerterm()
    {
        return $this->hasMany('App\Customerterm');
    }
     public function customervehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
