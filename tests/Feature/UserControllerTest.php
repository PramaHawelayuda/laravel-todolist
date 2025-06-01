<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginController()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginSuccess()
    {
        $this->get('/login', [
            'user' => 'prama',
            'password' => 'rahasia'
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'prama');
    }
}
