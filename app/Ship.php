<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $fillable = ['x', 'y', 'length', 'shot_counter', 'user_id'];

    // One score belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
