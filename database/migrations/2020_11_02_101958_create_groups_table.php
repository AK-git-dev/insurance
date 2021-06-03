<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('create_rider_id');
            $table->string('group_name');
            $table->string('group_image');
            $table->float('group_rating')->default(0);
            $table->string('city')->nullable();
            $table->text('group_desc')->nullable();
            $table->unsignedInteger('total_group_members')->default(0);
            $table->unsignedBigInteger('total_km')->default(0);
            $table->unsignedBigInteger('total_rides')->default(0);
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
        Schema::dropIfExists('groups');
    }
}
