<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->string('ad_id',150);
            $table->integer('ad_site')->unsigned();
            $table->integer('num_rooms')->unsigned();
            $table->float('total_area')->unsigned();
            $table->float('living_space')->nullable();
            $table->float('kitchen_area')->nullable();
            $table->integer('floor')->unsigned()->nullable();
            $table->integer('floor_house')->unsigned()->nullable();
            $table->integer('building_type')->unsigned()->nullable();
            $table->integer('house_layout')->unsigned()->nullable();
            $table->string('construction_year',150)->nullable();
            $table->integer('bathroom')->unsigned()->nullable();
            $table->string('furnished',150)->nullable();   
            $table->float('ceiling_height')->nullable();
            $table->text('title')->nullable();
            $table->text('body')->nullable();
            $table->longText('img')->nullable();
            $table->text('apartment_has')->nullable();
            $table->text('near_has')->nullable();
            $table->integer('remont')->nullable();
            $table->longText('price',150)->nullable();
            $table->string('commission',150)->nullable();
            $table->string('url',150)->nullable();
            $table->integer('house_type')->unsigned()->nullable();
            $table->integer('category')->unsigned()->nullable();
            $table->integer('city')->unsigned()->nullable();
            $table->integer('region')->unsigned()->nullable();
            $table->integer('other_loc')->unsigned()->nullable();
            $table->string('map', 190)->nullable();
            $table->longText('ad_update_at')->nullable();
            $table->integer('status')->default(1);
            $table->text('slug');
            $table->softDeletes();
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
        Schema::table('estates', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
