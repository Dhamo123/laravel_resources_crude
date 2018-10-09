<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
   protected $table = 'product_img';
   protected $fillable = [
        'photo',
        'pro_id',
        'created_at',
        'updated_at'
        // add all other fields
    ];
}
