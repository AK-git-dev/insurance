<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRideDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ride_id');
            $table->string('start_location');
            $table->string('end_location');
            $table->string('number_of_day');
            $table->date('start_date');
            $table->integer('ride_rating')->default(0);
            $table->integer('total_km')->default(0);
            $table->integer('is_petrol_pump')->default(0);
            $table->string('petrol_pump_comment')->nullable();
            $table->integer('is_restaurant')->default(0);
            $table->string('is_restaurant_comment')->nullable();
            $table->integer('is_hotel')->default(0);
            $table->string('hotel_comment')->nullable();
            $table->string('hotel_name')->nullable();
            $table->integer('is_parking')->default(0);
            $table->integer('is_wifi')->default(0);
            $table->integer('road_type');
            $table->string('road_type_comment')->nullable();
            $table->integer('road_quality');
            $table->integer('road_scenic');
            $table->text('day_description')->nullable();
            $table->text('ride_images')->nullable();
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
        Schema::dropIfExists('ride_days');
    }
}
