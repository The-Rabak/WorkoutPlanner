<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UseCaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_workout_can_be_added_to_a_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();

        $workout = Workout::factory()->create();

        $category->workouts()->save($workout);

        $this->assertCount(1, $category->fresh()->workouts);
    }
}
