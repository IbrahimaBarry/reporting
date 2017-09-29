<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num', 'nbrDoc', 'nbrPage', 'observation', 'completed'
    ];

    public function projet()
    {
    	return $this->belongsTo(Projet::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
