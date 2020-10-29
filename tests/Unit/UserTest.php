<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

// use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    use RefreshDatabase, WithFaker;


    // LEFT OFF HERE - 10/29/20

    /** @test     */
    public function a_user_has_projects() {
        $this->withoutExceptionHandling();
        $user = User::factory('App\User')->create();
        dd($user);
        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
