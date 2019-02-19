<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShotRequest;
use App\Shot;
use Illuminate\Http\Request;

class ShotController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShotRequest $shotRequest)
    {
        $shots = auth()->user()->shots()->get();
        $shotsCount = $shots->count() + 1;
        $shipFired = null;
        $state = 0; //water or success

        foreach ($shots as $shot) {
            if ($shot->x == $shotRequest->data['x'] && $shot->y == $shotRequest->data['y'] ){

                $shot = Shot::create([
                    'x' => $shot->x,
                    'y' => $shot->y,
                    'ship_id' => $shot->ship_id,
                    'user_id' => $shot->user_id,
                ]);

                return response()->json([
                    'state' => $state,
                    'ship' => $shipFired,
                    'shotsCount' => $shotsCount,
                ]);
            }
        }

        $shipId = null;
        $ships = auth()->user()->ships()->get();

        foreach ($ships as $ship){

            $x = $ship->x;
            $y = $ship->y;

            for ($i = 0; $i < $ship->length; $i++){

                if ($x == $shotRequest->data['x'] && $y == $shotRequest->data['y'] ){
                    $state = 1;
                    $shipId = $ship->id;
                    $shot_counter = $ship->shot_counter + 1;

                    $ship->update([
                        'shot_counter' => $shot_counter,
                    ]);

                    $shipFired = $ship;

                    break;
                }

                if ($ship->axis === 'H'){
                    $x++;
                }
                else{
                    $y++;
                }
            }

            if (!is_null($shipFired)){
                break;
            }
        }

        Shot::create([
            'x' => $shotRequest->data['x'],
            'y' => $shotRequest->data['y'],
            'user_id' => auth()->user()->id,
            'ship_id' => $shipId,
        ]);


        return response()->json([
            'state' => $state,
            'ship' => $shipFired,
            'shotsCount' => $shotsCount,
        ]);
    }

    public function myShots()
    {
        $shots = auth()->user()->shots()->get();

        return response()->json([
            'shots' => $shots,
        ]);
    }

}
