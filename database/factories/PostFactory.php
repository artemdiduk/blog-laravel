<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Group;
class PostFactory extends Factory
{
    /**
     * Название модели, соответствующей фабрике.
     *
     * @var string
     */
    protected $model = Post::class;

    public function definition()
    {
        $randomText = $this->faker->unique()->realText(10);
        return [
            'name' => $randomText,
            'slag' => Str::slug($randomText),
            'description' => $this->faker->realText(200),
            'img' => null,
            'group_id' => Group::factory(),
            'user_id' => User::factory(),
        ];
    }
}
