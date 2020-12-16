<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    
    public function blog() {
		return $this->belongsToMany(Blog::class);
	}
}
