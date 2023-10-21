<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\File;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {

        $data = [
            [
                'user_id' => '9a6c055e-b2a8-43de-b739-67f023a05f3e',
                'fileName' => 'uploads/9a6c055e-b2a8-43de-b739-67f023a05f3e/download.jpg',
                'thumbnail' => 'uploads/9a6c055e-b2a8-43de-b739-67f023a05f3e/thumbnail/download.jpg',
                'stared' => false
            ],
            [
                'user_id' => '9a6c055e-b2a8-43de-b739-67f023a05f3e',
                'fileName' => 'uploads/9a6c055e-b2a8-43de-b739-67f023a05f3e/download.jpg',
                'thumbnail' => 'uploads/9a6c055e-b2a8-43de-b739-67f023a05f3e/thumbnail/download.jpg',
                'stared' => false
            ],
            [
                'user_id' => '9a6c055e-b2a8-43de-b739-67f023a05f3e',
                'fileName' => 'uploads/9a6c055e-b2a8-43de-b739-67f023a05f3e/download.jpg',
                'thumbnail' => 'uploads/9a6c055e-b2a8-43de-b739-67f023a05f3e/thumbnail/download.jpg',
                'stared' => false
            ],
        ];

        File::insert($data);
    }
}
