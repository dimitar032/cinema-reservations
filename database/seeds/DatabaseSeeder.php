<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //init project
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(MovieCategoriesSeeder::class);


        //fake data
        $this->call(MovieSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(ProjectionSeeder::class);

//        factory(\App\Building::class)->create(['user_id' => 1]);
//        factory(\App\Building::class)->create(['user_id' => 1]);
//        factory(\App\Building::class)->create(['user_id' => 1]);
//        factory(\App\Building::class)->create(['user_id' => 1]);
    }
}
