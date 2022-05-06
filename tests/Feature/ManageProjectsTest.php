<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_projects()
    {

        // $this->withoutExceptionHandling();

        $project =  Project::factory()->create();
        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }







    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->actingAs(User::factory()->create());



        $this->get('/projects/create')->assertStatus(200);

        $attribute = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
        $this->post('/projects', $attribute)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attribute);

        $this->get('/projects')->assertSee($attribute['title']);
    }
    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->be(User::factory()->create());

        $project =  Project::factory()->create(['owner_id' => auth()->id()]);
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
    /** @test */
    public function an_authonticated_user_cannot_view_the_projects_of_others()
    {
        $this->be(User::factory()->create());

        $project =  Project::factory()->create();
        $this->get($project->path())
            ->assertStatus(403);
    }


    /** @test */
    public function a_project_required_a_title()
    {
        $this->actingAs(User::factory()->create());

        $attribute =  Project::factory()->raw(['title' => '']);
        $this->post('/projects', $attribute)->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_project_required_a_description()
    {

        $this->actingAs(User::factory()->create());

        $attribute =  Project::factory()->raw(['description' => '']);
        $this->post('/projects', $attribute)->assertSessionHasErrors('description');
    }
}
