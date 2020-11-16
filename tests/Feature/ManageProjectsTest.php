<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

class ManageProjectsTest extends TestCase {

    use RefreshDatabase, WithFaker;
    
    
    /** @test */
    public function guests_cannot_manage_projects() {    
        $project = Project::factory('App\Project')->create();
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
        
    }
    

    /** @test */
    public function a_user_can_create_a_project() {
        
        $this->withoutExceptionHandling();

        // Note - this was another workaround I figured out ON MY OWN 10/28/20
        $user = User::factory('App\User')->create(); // create user and store as variable
        $this->actingAs($user); // sign somebody in - using variable

        $this->get('/projects/create')->assertStatus(200);


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
    public function a_user_can_view_their_project() {
        $this->withoutExceptionHandling();
        $this->be(User::factory('App\User')->create());
        $project = Project::factory('App\Project')->create(['owner_id' => auth()->id()]);
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }


    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others() {
        // $this->withoutExceptionHandling();
        $this->be(User::factory('App\User')->create());
        $project = Project::factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
    }   


}
