<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkoutTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function a_guest_cant_create_a_workout()
    {

        $response = $this->post("/workouts",
            ["title" => $this->faker->sentence(),
                "url" => $this->faker->url()]);

        $response->assertRedirect('/login');
    }
    /**
     * @test
     */
    public function a_user_can_create_a_workout()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $title = $this->faker->sentence();
        $response = $this->post("/workouts",
            ["title" => $title,
                "created_by_user_id" => auth()->id(),
                "url" => $this->faker->url()]);

        $response->assertRedirect('/workouts');
        $this->assertEquals($title, Workout::first()->title);
    }
}
