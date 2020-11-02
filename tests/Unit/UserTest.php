<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\Collection; // what came out of the box
use Illuminate\Database\Eloquent\Collection; // *Overridden what this came with out of the box for laravel 8
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

// use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    use RefreshDatabase, WithFaker;

    /** @test     */
    public function a_user_has_projects() {
        $this->withoutExceptionHandling();
        $user = User::factory('App\User')->create();
        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
