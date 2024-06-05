<?php

namespace App\Http\Controllers;

use App\Models\TennisCourt;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TennisCourtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tennisCourts = TennisCourt::all()->select('court_number', 'court_type', 'status');
        return Inertia::render('TennisCourt/All', [
            'tennisCourts' => $tennisCourts
        ]);
    }

    public function control()
    {
        $tennisCourts = TennisCourt::all()->select('court_number', 'court_type', 'status');
        return Inertia::render('TennisCourt/Control', [
            'tennisCourts' => $tennisCourts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TennisCourt $tennisCourt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TennisCourt $tennisCourt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TennisCourt $tennisCourt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TennisCourt $tennisCourt)
    {
        //
    }
}
