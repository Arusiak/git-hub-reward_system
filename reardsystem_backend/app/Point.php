<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from','to', 'quantity',
    ];

    public function from()
    {
        return $this->belongsTo('App\User', 'from');
    }

    public function to()
    {
        return $this->belongsTo('App\User', 'to');
    }
}
