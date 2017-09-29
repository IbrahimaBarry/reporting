<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nbrLot', 'description', 'completed', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }
}
