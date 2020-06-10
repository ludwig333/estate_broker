<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'property';

	public function property_type(){
		return $this->belongsTo('App\PropertyType','property_type_id');
	}

	public function location(){
		return $this->belongsTo('App\Location','location_id');


	}

	public function agent(){
		return $this->belongsTo('App\Agent','agent_id');
	}

	public function benefits(){
		return $this->belongsToMany('App\Benefit','property_benefits','property_id','benefit_id');
	}

	public function gallery(){
		return $this->hasMany('App\PropertyGallery','property_id');
	}
}
