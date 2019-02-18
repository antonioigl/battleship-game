<?php

namespace App\Http\Controllers;

use App\Score;
use App\Shot;
use Illuminate\Http\Request;

define ('TOTAL_SIZE_SHIPS', 4);

class ScoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = Score::orderBy('points', 'desc')->get();
        return view('scores.index', compact('scores'));

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
    public function store()
    {
        $urlRedirect = '/scores/show';

        $user = auth()->user();
        $totalShots =$user->shots()->count();
        $score = round(TOTAL_SIZE_SHIPS/$totalShots, 4);

        $user->shots()->delete();
        $user->ships()->delete();

        Score::create([
            'points' => $score,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'urlRedirect' => $urlRedirect,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $scores = auth()->user()->scores()->orderBy('points', 'desc')->get();
        return view('scores.scores', compact('scores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
