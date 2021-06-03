<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rider_id');
            $table->unsignedInteger('riding_year')->default(0);
            $table->unsignedInteger('total_km')->default(0);
            $table->unsignedInteger('total_rides')->default(0);
            $table->string('image')->nullable();
            $table->string('cover_image')->nullable();
            $table->float('rating')->default(0);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('rider_profiles');
    }
}
