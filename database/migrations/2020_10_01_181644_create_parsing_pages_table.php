<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParsingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsing_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('site_id')->nullable();
            $table->string('category',150)->nullable();
            $table->string('housingtype',150)->nullable();
            $table->string('city',150)->nullable();
            $table->string('region',150)->nullable();
            $table->text('url')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('parsing_pages');
    }
}
