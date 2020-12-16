<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
   use SoftDeletes;

   protected $guarded = [];

    public function category() {
		return $this->belongsToMany(Category::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}
