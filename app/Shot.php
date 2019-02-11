<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shot extends Model
{
    protected $fillable = ['x', 'y', 'user_id', 'ship_id'];

    // One score belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
