<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class FiboControllerTest extends TestCase
{
    use WithoutMiddleware;
    const API_BASE_URL = '/api/v1/fibonacci';

    public function testFailedValidationTest()
    {
        $response = $this->get(self::API_BASE_URL . '?from=text'
        );
        $response->assertStatus(422);

        $response = $this->get(self::API_BASE_URL . '?to=text');
        $response->assertStatus(422);

        $response = $this->get(self::API_BASE_URL . '?from=10&to=text');
        $response->assertStatus(422);

        $response = $this->get(self::API_BASE_URL . '?from=10&to=5');
        $response->assertStatus(422);
    }

    public function testRightResult()
    {
        $structure = [
            'data' => []
        ];

        $response = $this->get(self::API_BASE_URL . '?from=0&to=5');

        $response
            ->assertStatus(200)
            ->assertJsonStructure($structure)
            ->assertJson([
                'data' => [0,1,1,2,3]
            ]);
    }



}
