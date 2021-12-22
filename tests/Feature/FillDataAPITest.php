<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FillDataAPITest extends TestCase
{
    /**
     *
     *
     * @return void
     */
    public function status_test()
    {
        $response = $this->get('/api/covid/fill_data');

        $response->assertStatus(200);
    }

    public function response_size_test(){
        $response = $this->get('/api/covid/fill_data');

        $response->ass();
    }
}
