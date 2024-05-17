<?php

namespace Tests\Feature;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
//        $this->withoutExceptionHandling();

        $response = $this->get('/' . LaravelLocalization::getCurrentLocale());

        $response->assertStatus(200);
    }
}
