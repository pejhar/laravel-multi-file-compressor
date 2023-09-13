<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadTest extends TestCase
{
    /**
     * A basic test for upload a file.
     */
    public function test_the_successful_upload(): void
    {

        Storage::fake('uploads');
        $file = UploadedFile::fake()->create('document.pdf', 300);
        $folderName = 'A91273E64E0D0A111F44B5A3C3A40F90';
        $FileName = 'document.pdf';
        $filename = '/var/www/html/public/'.$folderName.'/'.$FileName; 
        $response = $this->json('POST', '/api/file/upload', [
            'file' => UploadedFile::fake()->create('document.pdf'),
            'folder_name'=> $folderName
        ]);

    
        // Assert function to test whether given 
        // file path exists or not 
        $this->assertFileExists( 
            $filename, 
            "given filename doesn't exists"
        ); 

    }

}
