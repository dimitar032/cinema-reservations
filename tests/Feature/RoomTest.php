<?php

namespace Tests\Feature;

use App\Building;
use App\Room;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomTest extends TestCase
{
    protected $building;

    protected function setUp()
    {
        parent::setUp();

        $this->signIn();
        auth()->user()->assignRole('manager');
        $this->building = factory(Building::class)->create([
            'user_id' => auth()->id(),
        ]);
    }

    /** @test - RoomController@index*/
    public function user_can_see_rooms()
    {
        factory(Room::class)->create([
            'building_id' => $this->building->id,
        ]);
        factory(Room::class)->create([
            'building_id' => $this->building->id,
        ]);

        $response = $this->get(route('building.room.index', $this->building->id));

        $this->assertEquals(2, $this->building->rooms()->count());
        $response->assertViewHas('rooms');
    }

    /** @test - RoomController@store */
    public function user_can_store_room()
    {
        $this->post(route('building.room.store', $this->building->id), [
            'name' => 'Room 1',
            'row' => 6,
            'col' => 6,
        ]);

        $this->assertEquals(1, $this->building->rooms()->count());
        $this->assertEquals('Room 1', $this->building->rooms()->first()->name);
    }

    /** @test - RoomController@edit */
    public function manager_can_edit_his_room()
    {
        $room = factory(Room::class)->create([
            'building_id' => $this->building->id,
        ]);

        $response = $this->get(route('building.room.edit', [$this->building, $room]));

        $response->assertViewHas('room');
    }

    /** @test - RoomController@update */
    public function manager_can_update_his_room()
    {
        $room = factory(Room::class)->create([
            'name' => 'Room1',
            'building_id' => $this->building->id,
        ]);

        $this->put(route('building.room.update', [$this->building, $room]), [
            'name' => 'Room1337',
        ]);

        $updatedRoom = $this->building->rooms()->first();
        $this->assertSame('Room1337', $updatedRoom->name);
    }

    /** @test - RoomController@destroy */
    public function manager_can_destroy_his_room()
    {
        $room = factory(Room::class)->create([
            'name' => 'Room1',
            'building_id' => $this->building->id,
        ]);

        $response = $this->delete(route('building.room.destroy', [$this->building, $room]));

        $response->assertStatus(200);
        $this->assertSame(0, $this->building->rooms()->count());
    }
}
