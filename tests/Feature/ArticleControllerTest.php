<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
    }

    public function testGuestCreate()
    {
        $responce = $this->get(route('articles.create'));

        $responce->assertRedirect(route('login'));
    }
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $responce = $this->actingAs($user)
            ->get(route('articles.create'));
            
        $responce->assertStatus(200)
            ->assertViewIs('articles.create');
    }
}
