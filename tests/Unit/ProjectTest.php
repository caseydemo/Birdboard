<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use \Tests\Testcase as WOOHOO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Project;

// the woohoo thing is goofy... but it works 10/15/20
class ProjectTest extends WOOHOO
{
    /**
     * @test
     */
    public function it_has_a_path() {
        $project = Project::factory('App\Project')->raw();
        dd($project);
        $this->assertEquals('/projects/' . $project->id, $project->path());
    }



    /** @test */
    // public function it_has_a_path() {
    //     $project = Project::factory('App\Project')->create();
    //     dd($project);
    //     // $this->assertEquals('/projects/' . $project->id, $project->path());
    // }




}
