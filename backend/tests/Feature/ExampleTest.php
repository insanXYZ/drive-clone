<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\File;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        Storage::disk("public")->delete("uploads/9a6d1d22-8473-44e7-903b-df6bb5e5b7ad/". File::find("9a7926e9-7e00-438e-b8a6-71a82a34cd1e")->fileName);
    }
}
