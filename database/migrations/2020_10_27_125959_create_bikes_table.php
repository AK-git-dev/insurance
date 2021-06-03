<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('rider_id');
            $table->unsignedBigInteger('total_km');
            $table->unsignedBigInteger('total_rides');
            $table->text('image')->nullable();
            $table->unsignedBigInteger('comfortness')->nullable();
            $table->unsignedBigInteger('reliability')->nullable();
            $table->unsignedBigInteger('visual_appeal')->nullable();
            $table->unsignedBigInteger('performance')->nullable();
            $table->unsignedBigInteger('service_experience')->nullable();
            $table->text('info')->nullable();
            $table->integer('is_approved')->default(0);
            $table->integer('updated_by')->default(0);
            $table->string('ip_address')->nullable();
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
        Schema::dropIfExists('bikes');
    }
}
