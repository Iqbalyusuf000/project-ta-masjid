<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisionMission;

class VisionMissionController extends Controller
{
    public function index()
    {
        try {
            $visionMission = VisionMission::first();

            if (!$visionMission) {
                return response()->json([
                    'error' => 'Data tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'data' => [
                    'id' => $visionMission->id,
                    'visi' => $visionMission->visi,
                    'misi' => $visionMission->misi,
                    'created_by' => $visionMission->created_by
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }
}
