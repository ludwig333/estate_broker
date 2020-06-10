<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_categories';
	
	 public function post()
	 {
		return $this->hasMany('App\Blog','cat_id');

	 }
}