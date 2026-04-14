<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

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
