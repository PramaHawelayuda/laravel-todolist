<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginForMember()
    {
        $this->withSession([
            'user' => 'prama'
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->get('/login', [
            'user' => 'prama',
            'password' => 'rahasia'
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'prama');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText('User or password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'wrong',
            'password' => 'wrong'
        ])->assertSeeText('User or password is wrong');
    }

    public function testLogout()
    {
        $this->withSession([
            'user' => 'prama'
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function testGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
