<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
class GroupFactory extends Factory
{
    /**
     * Название модели, соответствующей фабрике.
     *
     * @var string
     */
    protected $model = Group::class;
    public function definition()
    {
        $name = $this->faker->unique()->sentence(5);
        return [
            'name' => $name,
            'slag' => Str::slug($name),
            'user_id' => User::factory()
        ];
    }
}
