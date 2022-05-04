<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;



    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attribute = [
            'title' =>  $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];
        $this->post('/projects', $attribute);

        $this->assertDatabaseHas('projects', $attribute);

        $this->get('/projects')->assertSee($attribute['title']);
    }
}
