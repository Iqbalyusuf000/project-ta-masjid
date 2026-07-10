<?php

namespace App\Http\Controllers;

use App\Models\KajianCategory;
use App\Models\KajianDetail;
use Illuminate\Http\Request;

class KajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the closest upcoming agenda (where date >= today)
        $agendaTerdekat = KajianDetail::with(['kajian.kajianCategory', 'ustadz', 'location'])
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->first();

        return view('pages.kajian', [
            'agendaTerdekat' => $agendaTerdekat,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(KajianDetail $kajianDetail)
    {
        $kajianDetail->load(['kajian.kajianCategory', 'ustadz', 'location']);

        return view('pages.kajian-detail', [
            'kajianDetail' => $kajianDetail,
        ]);
    }
}
