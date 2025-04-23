<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('movies')->insert([
    		'name' => 'Cinderella',
    		'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
    		'premiere_date'=>Carbon::now()->format('Y-m-d'),
    		'poster'=>'movie_1.jpg',
    		'duration_in_minutes'=>rand(70,170),
    	]);

    	DB::table('movies')->insert([
    		'name' => '109 Hours',
    		'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
    		'premiere_date'=>Carbon::now()->subDays(5)->format('Y-m-d'),
    		'poster'=>'movie_2.jpg',
    		'duration_in_minutes'=>rand(70,170),
    	]);

    	DB::table('movies')->insert([
    		'name' => 'The Opera',
    		'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
    		'premiere_date'=>Carbon::now()->subDays(3)->format('Y-m-d'),
    		'poster'=>'movie_3.jpg',
    		'duration_in_minutes'=>rand(70,170),
    	]);

    	DB::table('movies')->insert([
    		'name' => 'Out of the way',
    		'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
    		'premiere_date'=>Carbon::now()->subDays(12)->format('Y-m-d'),
    		'poster'=>'movie_4.jpg',
    		'duration_in_minutes'=>rand(70,170),
    	]);

    	DB::table('movies')->insert([
    		'name' => 'Hamlet',
    		'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
    		'premiere_date'=>Carbon::now()->subDays(8)->format('Y-m-d'),
    		'poster'=>'movie_5.jpg',
    		'duration_in_minutes'=>rand(70,170),
    	]);

    }
}
