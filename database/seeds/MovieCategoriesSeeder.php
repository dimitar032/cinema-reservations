<?php

use Illuminate\Database\Seeder;

class MovieCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => 'Action']);
        DB::table('categories')->insert(['name' => 'Adventure']);
        DB::table('categories')->insert(['name' => 'Animation']);
        DB::table('categories')->insert(['name' => 'Biography']);
        DB::table('categories')->insert(['name' => 'Comedy']);
        DB::table('categories')->insert(['name' => 'Crime']);
        DB::table('categories')->insert(['name' => 'Documentary']);
        DB::table('categories')->insert(['name' => 'Drama']);
        DB::table('categories')->insert(['name' => 'Family']);
        DB::table('categories')->insert(['name' => 'Fantasy']);
        DB::table('categories')->insert(['name' => 'History']);
        DB::table('categories')->insert(['name' => 'Horror']);
        DB::table('categories')->insert(['name' => 'Music']);
        DB::table('categories')->insert(['name' => 'Musical']);
        DB::table('categories')->insert(['name' => 'Mystery']);
        DB::table('categories')->insert(['name' => 'Romance']);
        DB::table('categories')->insert(['name' => 'Sci-Fi']);
        DB::table('categories')->insert(['name' => 'Sport']);
        DB::table('categories')->insert(['name' => 'Thriller']);
        DB::table('categories')->insert(['name' => 'War']);
        DB::table('categories')->insert(['name' => 'Western']);

    }
}
