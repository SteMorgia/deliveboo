<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'description',
        'vat',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dishes()
    {
        return $this->hasMany('App\Dish');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}

