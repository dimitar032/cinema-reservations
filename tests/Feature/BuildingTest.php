<?php

namespace Tests\Feature;

use App\Building;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuildingTest extends TestCase
{
    /**
     * assert status (where we prepare the data)
     * actual test what we want to test
     * assertions what we assert that we want to happen
     */

    /** @test BuildingController */
    function guests_can_not_see_building()
    {
        $this->withExceptionHandling();

        $this->get(route('building.index'))
            ->assertRedirect(route('login'));

        $this->get(route('building.create'))
            ->assertRedirect(route('login'));

        $this->post(route('building.store'))
            ->assertRedirect(route('login'));

        $this->get(route('building.edit', 1337))
            ->assertRedirect(route('login'));

        $this->put(route('building.update', 1337))
            ->assertRedirect(route('login'));

        $this->delete(route('building.destroy', 1337))
            ->assertRedirect(route('login'));


    }

    /** @test - BuildingController@index */
    // public function manager_can_see_his_buildings()
    // {
    //     $this->signIn();
    //     auth()->user()->assignRole('manager');

    //     $response = $this->get(route('building.index'));

    //     $response->assertViewHas('buildings');
    // }

    /** @test - BuildingController@store */
    public function manager_can_store_his_building()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');

        $response = $this->json('POST', route('building.store'), [
            'name' => 'Mall Plovdiv',
            'longitude' => 13,
            'latitude' => 37,
            'user_id' => auth()->id(),
        ]);
        $building = auth()->user()->buildings->first();

        $response->assertStatus(302);
        $this->assertSame(auth()->id(), $building->creator->id);
    }

    /** @test - BuildingController@edit */
    public function manager_can_edit_his_building()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');
        $building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);

        $response = $this->get(route('building.edit', $building->id));

        $response->assertViewHas('building');
    }

    /** @test - BuildingController@update */
    public function manager_can_update_his_building()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');
        $building = factory(Building::class)->create([
            'name' => 'Paradise Center',
            'user_id' => auth()->id(),
        ]);
        $this->assertSame('Paradise Center', $building->name);

        $this->json('PUT', route('building.update', $building), [
            'name' => 'Mall Plovdiv',
            'longitude' => 14,
            'latitude' => 35,
        ]);

        $updatedBuilding = auth()->user()->buildings->first();
        $this->assertSame('Mall Plovdiv', $updatedBuilding->name);
        $this->assertEquals(14, $updatedBuilding->longitude);
        $this->assertEquals(35, $updatedBuilding->latitude);
    }

    /** @test - BuildingController@destroy */
    public function manager_can_destroy_his_building()
    {
        $this->signIn();
        auth()->user()->assignRole('manager');
        $building = factory(Building::class)->create([
            'name' => 'Paradise Center',
            'user_id' => auth()->id(),
        ]);

        $response = $this->delete('/building/'.$building->id);

        $response->assertStatus(200);
        $this->assertSame(0, auth()->user()->buildings()->count());

    }

}
