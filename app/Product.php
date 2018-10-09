<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name',
        'qty',
        'created_at',
        'updated_at'
        // add all other fields
    ];
	public function photo()
    {
        return $this->hasOne('App\Photo','pro_id');
    }
}
