<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

class ProjectsTest extends TestCase {

    use RefreshDatabase, WithFaker;
    
    
    /** @test */
    public function only_authenticated_users_can_create_projects() {
        // this->withoutExceptionHandling();
        $attributes = Project::factory('App\Project')->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }
    
    /** @test */
    public function a_user_can_create_a_project() {
        
        // $this->withoutExceptionHandling();

        // Note - this was another workaround I figured out ON MY OWN 10/28/20
        $user = User::factory('App\User')->create(); // create user and store as variable
        $this->actingAs($user); // sign somebody in - using variable

        // Note it was erroring out in the controller validation because in the video, we don't pass the owner_id in the attributes - so I passed it
        $attributes = [
            'title' =>  $this->faker->sentence,
            'description'   =>  $this->faker->paragraph,
            'owner_id'   =>  $user->id
        ];
        
        $this->post('/projects', $attributes)->assertRedirect('/projects');

        
        $this->assertDatabaseHas('projects', $attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title() {

        $this->actingAs(User::factory('App\User')->create()); // sign somebody in
        $attributes = Project::factory('App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_project_requires_a_description() {

        $this->actingAs(User::factory('App\User')->create()); // sign somebody in
        $attributes = Project::factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');

    }



    

    /** @test */
    public function a_user_can_view_a_project() {
        $this->withoutExceptionHandling();
        $project = Project::factory('App\Project')->create();
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
}
