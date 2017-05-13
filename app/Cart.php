<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $table = 'cart';
	
	public function product()
	{
		return $this->hasOne('App\Product', 'id');
	}
}
