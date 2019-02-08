<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['points', 'user_id'];

    // One score belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
