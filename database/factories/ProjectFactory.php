<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  $this->faker->word,
            'description'   =>  $this->faker->paragraph,
            'owner_id'  =>  function() {
                // LEFT OFF HERE 10/20/20
                // return Project::factory(App\User::class)->create()->id;
            }  
        ];
    }
}
