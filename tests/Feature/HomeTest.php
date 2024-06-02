<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_users_can_see_the_homepage(): void
    {
        $this->refreshApplicationWithLocale('it');

        $this->get(route('home'))->assertOk();
    }
}
