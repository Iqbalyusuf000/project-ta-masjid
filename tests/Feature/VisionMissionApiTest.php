<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\VisionMission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisionMissionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_vision_mission_success(): void
    {
        $user = User::factory()->create();
        
        $visionMission = VisionMission::create([
            'visi' => 'Visi Kami',
            'misi' => 'Misi Kami',
            'created_by' => $user->id
        ]);

        $response = $this->getJson('/api/vision-mission');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $visionMission->id,
                    'visi' => $visionMission->visi,
                    'misi' => $visionMission->misi,
                    'created_by' => $user->id,
                ]
            ]);
    }

    public function test_get_vision_mission_not_found(): void
    {
        $response = $this->getJson('/api/vision-mission');

        $response->assertStatus(404)
            ->assertJson([
                'error' => 'Data tidak ditemukan'
            ]);
    }
}
