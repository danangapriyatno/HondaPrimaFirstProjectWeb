<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresaleUpload extends Model
{
                     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
       													  						
    protected $fillable = [
        'id', 'filename', 'mime','down_payment','original_filename','presale_no'
    ];
       public function customeruploadpresale()
	{
    	return $this->belongsTo('App\Presale','presale_no','presales_no');
	}
}
