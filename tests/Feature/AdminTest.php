<?php

namespace Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_requires_login(): void
    {
        $this->get('/admin')
            ->assertRedirect('/admin/login');
    }
}
