<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    const TOTAL_SHIPS = 4;
    protected $fillable = ['x', 'y', 'axis', 'length', 'shot_counter', 'user_id'];

    // One score belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isSunken()
    {
        return $this->length == $this->shot_counter;
    }

    public static function isGameOver()
    {
        $userId = auth()->user()->id;

//        $count = static::where('user_id', $userId)->whereRaw('length = shot_counter')->count();
//        var_dump($count);

        return static::where('user_id', $userId)->whereRaw('length = shot_counter')->count() == self::TOTAL_SHIPS;
    }

}
