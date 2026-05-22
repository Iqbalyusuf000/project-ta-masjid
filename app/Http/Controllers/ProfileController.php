<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationPeriod;
use App\Models\VisionMission;

class ProfileController extends Controller
{
    public function index()
    {
        // VISION MISSION
        $visionMission = VisionMission::first();

        // ACTIVE PERIOD
        $activePeriod = OrganizationPeriod::query()
            ->active()
            ->first();

        // ORGANIZATIONS
        $organizations = Organization::query()
            ->with([
                'member:id,name,photo',
                'position:id,name',
                'division:id,name',
            ])
            ->where('organization_period_id', $activePeriod?->id)
            ->active()
            ->ordered()
            ->get();

        // ADVISORS
        $advisors = $organizations
            ->filter(
                fn($item) =>
                $item->division?->name === 'Dewan Penasehat'
            )
            ->values();

        // =========================================
        // DAILY MANAGEMENT
        // =========================================
        $dailyManagement = $organizations
            ->filter(
                fn($item) =>
                $item->division?->name === 'Pengurus Harian'
            );

        // Ketua
        $chairman = $dailyManagement
            ->first(
                fn($item) =>
                $item->position?->name === 'Ketua Umum'
            );

        // Sekretaris
        $secretary = $dailyManagement
            ->first(
                fn($item) =>
                $item->position?->name === 'Sekretaris'
            );

        // Bendahara
        $treasurer = $dailyManagement
            ->first(
                fn($item) =>
                $item->position?->name === 'Bendahara'
            );

        // DIVISIONS
        $divisions = $organizations
            ->filter(
                fn($item) =>
                !in_array($item->division?->name, [
                    'Dewan Penasehat',
                    'Pengurus Harian',
                ])
            )
            ->groupBy(fn($item) => $item->division?->name);

        return view('pages.profile', [
            'visionMission' => $visionMission,
            'activePeriod' => $activePeriod,
            'advisors' => $advisors,
            'chairman' => $chairman,
            'secretary' => $secretary,
            'treasurer' => $treasurer,
            'divisions' => $divisions,
        ]);
    }
}