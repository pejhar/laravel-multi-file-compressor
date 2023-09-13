<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FolderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_the_application_create_a_folder(): void
    {
        $response = $this->get('/api/folder/compress');

        $response->assertStatus(201);
    }

}
