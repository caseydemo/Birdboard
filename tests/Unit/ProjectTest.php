<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use \Tests\Testcase as WOOHOO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Project;
use App\Models\User;

/*

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
*/

// the woohoo thing is goofy... but it works 10/15/20
class ProjectTest extends WOOHOO
{

    use RefreshDatabase, WithFaker;
    /**
     * @test
     */
    public function it_has_a_path() {
        $this->withoutExceptionHandling();
        $project = Project::factory('App\Project')->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    /** @test */
    public function it_belongs_to_an_owner() {
        $project = Project::factory('App\Project')->create();
        
        $this->assertInstanceOf('App\Models\User', $project->owner);
    }

}
