<?php

namespace App\Http\Controllers;

use App\Ship;
use Illuminate\Http\Request;

class ShipController extends Controller
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
//        $shipsCount = auth()->user()->ships()->count();
//
//        if ($shipsCount){
//            return view('ships.create');
//        }

        $userId = auth()->user()->id;
//        Ship::where('user_id', $userId)->delete();
        $ships = ['carrier' => 5, 'battleship' => 4, 'submarine' => 3, 'destroyer' => 2];

        foreach ($ships as $ship){

            $isValidShipInGrid = false;

            while (!$isValidShipInGrid){

                $x = rand(1,10);
                $y = rand(1,10);
                $size = $ship;
                $axis = ['V', 'H'];

                $key = array_rand($axis);
                $axis = $axis[$key];

                $isValidShipInGrid = $this->validateShipInGrid($x, $y, $size, $axis);
            }

            var_dump($x);
            var_dump($y);
            var_dump($axis);
            var_dump($ship);
            var_dump($userId);
//            dd('done');

            $sucess = Ship::create([
                'x' => $x,
                'y' => $y,
                'axis' => $axis,
                'length' => $ship,
                'shot_counter' => 0,
                'user_id' => $userId,
            ]);


        }

        die('done!');

        return view('ships.create');
    }

    private function validateShipInGrid($x, $y, $size, $axis)
    {
        $ships = auth()->user()->ships()->get();

        if ( ($axis == 'H') && (($x + $size) > 10) ){
            return false;
        }

        if ( ($axis == 'V') && (($y + $size) > 10) ){
            return false;
        }

        $xCount = $x;
        $yCount = $y;

        foreach ($ships as $ship) {
            $sx = $ship->x;
            $sy = $ship->y;
            for ($i = 0; $i < $ship->length; $i++){
                for ($j = 0; $j < $size; $j++){
                    if ($sx == $xCount && $sy == $yCount){
                        return false;
                    }
                    if ($axis == 'H'){
                        $xCount++;
                    }
                    else{
                        $yCount++;
                    }
                }

                $xCount = $x;
                $yCount = $y;

                if ($ship->axis == 'H'){
                    $sx++;
                }
                else{
                    $sy++;
                }
            }
        }

        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ship $ship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ship $ship)
    {
        //
    }

    public function myShips()
    {
        $ships = auth()->user()->ships()->get();

        return response()->json([
            'ships' => $ships,
        ]);
    }
}
