<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RickTest extends TestCase
{
    /**
     * Test if api works.
     */
    public function test_if_api_is_live(): void
    {
        $response = $this->get('/api/list');

        $response->assertStatus(200);
    }

    public function test_if_api_returns_pages(): void
    {
        $response = $this->get('/api/list');

        $response->assertStatus(200)
            ->assertJson(static fn(AssertableJson $json) => $json->has('info.pages')->etc());
    }
}
