<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
        });
        DB::table('cities')->insert(['name' => 'Sofia']);
        DB::table('cities')->insert(['name' => 'Plovdiv']);
        DB::table('cities')->insert(['name' => 'Varna']);
        DB::table('cities')->insert(['name' => 'Burgas']);
        DB::table('cities')->insert(['name' => 'Ruse']);
        DB::table('cities')->insert(['name' => 'Vidin']);

        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('longitude');
            $table->float('latitude');

            $table->unsignedInteger('user_id')->comment('Creator of the building');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedInteger('city_id');
            $table->foreign('city_id')
            ->references('id')
            ->on('cities');

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('favorite_building_id')->nullable();
            $table->foreign('favorite_building_id')
            ->references('id')
            ->on('buildings')
            ->onDelete('set null')
            ->onUpdate('cascade');
        });

        Schema::create('building_user', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('building_id');
            $table->foreign('building_id')
            ->references('id')
            ->on('buildings')
            ->onDelete('cascade')
            ->onUpdate('cascade'); 

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade'); 

            $table->unique(['building_id', 'user_id']);

            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->unsignedInteger('building_id');
            $table->foreign('building_id')
            ->references('id')
            ->on('buildings')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('col');
            $table->unsignedSmallInteger('row');
            $table->unsignedSmallInteger('reservable')->default(1);

            $table->unsignedInteger('room_id');
            $table->foreign('room_id')
            ->references('id')
            ->on('rooms')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unique(['col', 'row', 'room_id']);

            $table->timestamps();
        });


        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
        });

        // Schema::create('age_categories', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name')->unique();
        // });

        // DB::table('age_categories')->insert(['name' => 'Under 12']);
        // DB::table('age_categories')->insert(['name' => 'Under 16']);
        // DB::table('age_categories')->insert(['name' => 'Under 18']);

//
//        //todo: later implementation
//        Schema::create('actors', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//        });
//
//        //todo: later implementation
//        Schema::create('directors', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//        });

        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->date('premiere_date');
            $table->string('poster')->nullable();
            $table->unsignedSmallInteger('duration_in_minutes');
            
            // $table->foreign('age_category')
            //     ->references('id')
            //     ->on('age_categories');

            $table->timestamps();
        });

        Schema::create('building_movie', function (Blueprint $table) {
            $table->increments('id');
//            $table->unsignedTinyInteger('priority')->default(5); todo do it later for tests

            $table->unsignedInteger('building_id');
            $table->foreign('building_id')
            ->references('id')
            ->on('buildings')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedInteger('movie_id');
            $table->foreign('movie_id')
            ->references('id')
            ->on('movies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('category_movie', function (Blueprint $table) {
            $table->unique(['category_id', 'movie_id']);

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedInteger('movie_id');
            $table->foreign('movie_id')
            ->references('id')
            ->on('movies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('projections', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('start');

            $table->unsignedInteger('movie_id');
            $table->foreign('movie_id')
            ->references('id')
            ->on('movies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedInteger('room_id');
            $table->foreign('room_id')
            ->references('id')
            ->on('rooms')
            ->onDelete('cascade')
            ->onUpdate('cascade');
//
            $table->timestamps();
        });


//        //todo: later implementation
//        Schema::create('director_movie', function (Blueprint $table) {
//            $table->unique(['director_id', 'movie_id']);
//
//            $table->unsignedInteger('director_id');
//            $table->foreign('director_id')
//                ->references('id')
//                ->on('directors')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->unsignedInteger('movie_id');
//            $table->foreign('movie_id')
//                ->references('id')
//                ->on('movies')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->timestamps();
//        });
//
//        Schema::create('actor_movie', function (Blueprint $table) {
//            $table->unique(['actor_id', 'movie_id']);
//
//            $table->unsignedInteger('actor_id');
//            $table->foreign('actor_id')
//                ->references('id')
//                ->on('actors')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->unsignedInteger('movie_id');
//            $table->foreign('movie_id')
//                ->references('id')
//                ->on('movies')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->timestamps();
//        });
//
//        Schema::create('comments', function (Blueprint $table) {
//            $table->increments('id');
//
//            $table->unsignedInteger('user_id');
//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->unsignedInteger('movie_id');
//            $table->foreign('movie_id')
//                ->references('id')
//                ->on('movies')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->timestamps();
//        });
//
//        Schema::create('rating', function (Blueprint $table) {
//            $table->increments('id');
//
//            $table->unique(['user_id', 'movie_id']);
//
//            $table->unsignedInteger('user_id');
//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->unsignedInteger('movie_id');
//            $table->foreign('movie_id')
//                ->references('id')
//                ->on('movies')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->timestamps();
//        });


        Schema::create('reservation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('reservation_types')->insert(['name' => 'new']);
        DB::table('reservation_types')->insert(['name' => 'used']);
        DB::table('reservation_types')->insert(['name' => 'canceled']);
        DB::table('reservation_types')->insert(['name' => 'direct_sell']);

        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('reservation_type_id');
            $table->foreign('reservation_type_id')
            ->references('id')
            ->on('reservation_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedInteger('projection_id');
            $table->foreign('projection_id')
            ->references('id')
            ->on('projections')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedInteger('seat_id');
            $table->foreign('seat_id')
            ->references('id')
            ->on('seats')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unique(['user_id','projection_id','seat_id']);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
