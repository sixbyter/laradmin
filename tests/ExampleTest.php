<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }

    public function testGuest(){
        $this->get('/dashboard/welcome')
             ->assertRedirectedTo('/auth/login');
    }

    public function testAuth(){
        $this->visit('/auth/login')
         ->type('liuzhijie@meiriq.com', 'email')
         ->type('meiriq2014', 'password')
         ->press('Login')
         ->seePageIs('/dashboard/welcome');
    }

    public function testWelcome(){
        $user = new \App\User();
        $user = $user->find(1);
        $this->actingAs($user)
             ->visit('/dashboard/welcome')
             ->seeStatusCode(200)
             ->see('欢迎光临');
    }
}
