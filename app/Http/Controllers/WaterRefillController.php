<?php

namespace App\Http\Controllers;

use App\Models\WaterRefill;
use Illuminate\Http\Request;

class WaterRefillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all data on water refill
        $waterRefill = WaterRefill::where('is_active', true)->get();

        // price 
        $price = WaterRefill::where('name', 'Isi Ulang Galon')->first();

        return view('pages.water-refill', [
            'waterRefill' => $waterRefill,
            'price' => $price
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
    public function show(WaterRefill $waterRefill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaterRefill $waterRefill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaterRefill $waterRefill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaterRefill $waterRefill)
    {
        //
    }
}
