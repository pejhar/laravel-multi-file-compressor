<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompressTest extends TestCase
{

    /**
     * A test to verify that the file name does not exist.
     */
    public function test_the_file_does_not_exist(): void
    {
        $response = $this->json('GET', 'api/file/compress', [
            'file_name' => 'A91273E64E0D0A111F44B5A3C3A40F90',
            // 'file_type'=> '.tar.gz'
        ]);
        $response->assertStatus(422);

    }
}
