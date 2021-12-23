<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FillDataAPITest extends TestCase
{
    /**
     * test API request status
     * @return void
     */
    public function status_test()
    {
        $response = $this->get('/api/covid/fill_data');
        $response->assertStatus(200);
    }
}
