<?php

namespace Tests\Feature;

use App\Building;
use App\Movie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuildingMovieTest extends TestCase
{
    /** @test - BuildingMovieController@store */
    public function manager_can_put_movie_into_his_building()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');

        $movie = factory(Movie::class)->create();
        $building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);

        $response = $this->post(route('building.movie.store', $building), [
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(302);
        $this->assertSame(1, $building->movies()->count());
    }

    /** @test - BuildingMovieController@store */
    public function building_can_have_this_movie_just_once()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');

        $movie = factory(Movie::class)->create();
        $building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);

        $building->movies()->attach($movie);

        $response = $this->post(route('building.movie.store', $building), [
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(302);
        $this->assertSame(1, $building->movies()->count());
    }

    /** @test - BuildingMovieController@destroy */
    public function manager_can_remove_movie_from_his_building()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');

        $movie = factory(Movie::class)->create();
        $building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);
        $building->movies()->attach($movie);

        $response = $this->delete(route('building.movie.destroy', [$building, $movie]));

        $response->assertStatus(302);
        $this->assertSame(0, $building->movies()->count());
    }


}
