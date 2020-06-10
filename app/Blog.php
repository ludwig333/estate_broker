<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_posts';
	
	public function category(){
		return $this->belongsTo('App\BlogCategory','cat_id');
	}
	
	public function author(){
		return $this->belongsTo('App\User','author_id');
	}
}