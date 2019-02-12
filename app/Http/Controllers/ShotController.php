<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShotRequest;
use App\Shot;
use Illuminate\Http\Request;

class ShotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
                    $y++;
                }
                else{
                    $x++;
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Shot  $shot
     * @return \Illuminate\Http\Response
     */
    public function show(Shot $shot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shot  $shot
     * @return \Illuminate\Http\Response
     */
    public function edit(Shot $shot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shot  $shot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shot $shot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shot  $shot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shot $shot)
    {
        //
    }
}
