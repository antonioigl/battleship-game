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
        var_dump($shotRequest->data['col']);
        var_dump($shotRequest->data['row']);
        die('done!');

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
