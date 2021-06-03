<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rider_id');
            $table->string('start_location');
            $table->text('via_location');
            $table->string('end_location');
            $table->string('slug');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('no_of_people');
            $table->text('short_description')->nullable();
            $table->text('rideDay');
            $table->text('luggage')->nullable();
            $table->float('total_km')->default(0);
            $table->float('rating')->default(0);
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
        Schema::dropIfExists('temp_rides');
    }
}
