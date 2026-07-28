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
        // Coba ambil kajian yang akan datang (>= hari ini)
        $agendaTerdekat = KajianDetail::with(['kajian.kajianCategory', 'ustadz', 'location'])
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->first();

        $isUpcoming = true;

        // Jika tidak ada kajian mendatang, tampilkan kajian terakhir yang ada
        if (! $agendaTerdekat) {
            $agendaTerdekat = KajianDetail::with(['kajian.kajianCategory', 'ustadz', 'location'])
                ->orderBy('date', 'desc')
                ->orderBy('start_time', 'desc')
                ->first();
            $isUpcoming = false;
        }

        return view('pages.kajian', [
            'agendaTerdekat' => $agendaTerdekat,
            'isUpcoming'     => $isUpcoming,
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
