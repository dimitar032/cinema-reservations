<?php

namespace Tests\Feature;

use App\Building;
use App\Movie;
use App\Room;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectionTest extends TestCase
{
    /** @test - ProjectionController@index */
    public function manager_can_see_room_projections()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');

        $building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);
        $room = $building->rooms()->create(['name' => 'Room 1']);

        $response = $this->get(route('building.room.projection.index', [$building, $room]));
        $response->assertViewHas('projections');
        $response->assertViewHas('room');
        $response->assertViewHas('building');
    }

    /** @test - ProjectionController@store */
    public function manager_can_create_projections_to_room()
    {
        $movie = factory(Movie::class)->create();
        $this->signIn();

        auth()->user()->assignRole('manager');
        $building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);
        $room = factory(Room::class)->create([
            'building_id' => $building->id
        ]);

        $response = $this->post(route('building.room.projection.store', [$building, $room]), [
            'start' => Carbon::now()->subWeek(),
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(302);
        $this->assertEquals(1, $room->projections()->count());
    }

    /** @test - ProjectionController@store */
    public function one_room_have_one_projection_per_time()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');
        $movie = factory(Movie::class)->create([
            'duration' => 60
        ]);
        $building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);
        $room = factory(Room::class)->create([
            'building_id' => $building->id
        ]);
        $room->projections()->create([
            'movie_id' => $movie->id,
            'start' => Carbon::now(),
        ]);

        $response = $this->post(route('building.room.projection.store', [$building, $room]), [
            'start' => Carbon::now()->addMinutes(40),
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(302);
        $this->assertEquals(1, $room->projections()->count());
    }

    /** @test - ProjectionController@store */
    public function multiple_projection_per_room_in_diff_time()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');
        $movie = factory(Movie::class)->create([
            'duration' => 60
        ]);
        $building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);
        $room = factory(Room::class)->create([
            'building_id' => $building->id
        ]);
        $room->projections()->create([
            'movie_id' => $movie->id,
            'start' => Carbon::now(),
        ]);

        $response = $this->post(route('building.room.projection.store', [$building, $room]), [
            'start' => Carbon::now()->addMinutes(90),
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(302);
        $this->assertEquals(2, $room->projections()->count());
    }
}
