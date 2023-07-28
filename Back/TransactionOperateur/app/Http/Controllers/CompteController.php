<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Http\Requests\StoreCompteRequest;
use App\Http\Requests\UpdateCompteRequest;

class CompteController extends Controller
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
     * @param  \App\Http\Requests\StoreCompteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function show(Compte $compte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function edit(Compte $compte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompteRequest  $request
     * @param  \App\Models\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompteRequest $request, Compte $compte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compte $compte)
    {
        //
    }
}
