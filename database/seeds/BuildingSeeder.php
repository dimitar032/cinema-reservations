<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Building;
class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert([
    		'name' => 'New Mall',
    		'latitude'=>123,
    		'longitude'=>124,
            'city_id'=>1,
            'user_id'=>1,
        ]);	
        $building = Building::find(1);
        $building->movies()->attach(1);
        $building->movies()->attach(2);
        $building->movies()->attach(3);
        $building->movies()->attach(4);

        $building->employees()->attach(2);

        $room = $building->rooms()->create(['name'=>'Large room']);
        for ($i = 0; $i < 15; $i++) {
            for ($j = 0; $j < 15; $j++) {
                $room->seats()->create([
                    'row' => $i,
                    'col' => $j,
                ]);
            }
        }
        
        $room = $building->rooms()->create(['name'=>'Medium room']);
        for ($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $room->seats()->create([
                    'row' => $i,
                    'col' => $j,
                ]);
            }
        }
        $room = $building->rooms()->create(['name'=>'Small Room']);
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $room->seats()->create([
                    'row' => $i,
                    'col' => $j,
                ]);
            }
        }

        DB::table('buildings')->insert([        
            'name' => 'Power Mall',
            'latitude'=>125,
            'longitude'=>126,
            'city_id'=>1,
            'user_id'=>1,
        ]); 
        $building = Building::find(2);
        $building->movies()->attach(3);
        $building->movies()->attach(4);
        $building->movies()->attach(5);
        $room = $building->rooms()->create(['name'=>'Small Room other building']);
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $room->seats()->create([
                    'row' => $i,
                    'col' => $j,
                ]);
            }
        }

        $room = $building->rooms()->create(['name'=>'med Room other building']);
        for ($i = 0; $i < 8; $i++) {
            for ($j = 0; $j < 8; $j++) {
                $room->seats()->create([
                    'row' => $i,
                    'col' => $j,
                ]);
            }
        }

        DB::table('buildings')->insert([
            'name' => 'Mall of People',
            'latitude'=>127,
            'longitude'=>128,
            'city_id'=>1,
            'user_id'=>1,
        ]); 

        DB::table('buildings')->insert([
            'name' => 'Legendary Mall',
            'latitude'=>129,
            'longitude'=>130,
            'city_id'=>2,
            'user_id'=>1,
        ]); 

        DB::table('buildings')->insert([
            'name' => 'Mallpopoly',
            'latitude'=>131,
            'longitude'=>132,
            'city_id'=>2,
            'user_id'=>1,
        ]); 
    }
}