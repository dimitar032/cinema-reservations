<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projections')->insert([
            'start' => Carbon::now()->setTime(12,00),
            'movie_id'=>1,
            'room_id'=>2,
        ]); 
        DB::table('projections')->insert([
            'start' => Carbon::now()->setTime(15,00),
            'movie_id'=>2,
            'room_id'=>1,
        ]); 
        DB::table('projections')->insert([
            'start' => Carbon::now()->setTime(17,00),
            'movie_id'=>1,
            'room_id'=>1,
        ]); 

        DB::table('projections')->insert([
    		'start' => Carbon::now()->setTime(16,00)->addDays(1),
    		'movie_id'=>1,
    		'room_id'=>1,
    	]); 

    	DB::table('projections')->insert([
    		'start' => Carbon::now()->setTime(12,20)->addDays(2),
    		'movie_id'=>1,
    		'room_id'=>1,
    	]); 
    	DB::table('projections')->insert([
    		'start' => Carbon::now()->setTime(15,20)->addDays(2),
    		'movie_id'=>1,
    		'room_id'=>2,
    	]); 
    	DB::table('projections')->insert([
    		'start' => Carbon::now()->setTime(21,00)->addDays(2),
    		'movie_id'=>1,
    		'room_id'=>2,
    	]); 

    	DB::table('projections')->insert([
    		'start' => Carbon::now()->setTime(12,20)->addDays(2),
    		'movie_id'=>2,
    		'room_id'=>1,
    	]); 
    	DB::table('projections')->insert([
    		'start' => Carbon::now()->setTime(15,20)->addDays(2),
    		'movie_id'=>2,
    		'room_id'=>1,
    	]); 
    	DB::table('projections')->insert([
    		'start' => Carbon::now()->setTime(21,00)->addDays(2),
    		'movie_id'=>2,
    		'room_id'=>1,
    	]); 

        DB::table('reservations')->insert([
            'reservation_type_id'=>1,
            'user_id'=>1,
            'projection_id'=>2,
            'seat_id'=>1
        ]);

         DB::table('reservations')->insert([
            'reservation_type_id'=>1,
            'user_id'=>1,
            'projection_id'=>2,
            'seat_id'=>2
        ]);

         DB::table('reservations')->insert([
            'reservation_type_id'=>1,
            'user_id'=>1,
            'projection_id'=>2,
            'seat_id'=>3
        ]);

         DB::table('reservations')->insert([
            'reservation_type_id'=>1,
            'user_id'=>1,
            'projection_id'=>2,
            'seat_id'=>4
        ]);


         DB::table('reservations')->insert([
            'reservation_type_id'=>1,
            'user_id'=>2,
            'projection_id'=>2,
            'seat_id'=>13
        ]);
         DB::table('reservations')->insert([
            'reservation_type_id'=>1,
            'user_id'=>2,
            'projection_id'=>2,
            'seat_id'=>14
        ]);
         DB::table('reservations')->insert([
            'reservation_type_id'=>3,
            'user_id'=>2,
            'projection_id'=>2,
            'seat_id'=>15
        ]);

    }
}
