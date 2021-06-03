<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('slug')->after('end_location');
            $table->string('cover_image')->after('slug')->nullable();
            $table->float('rating')->after('ride_days')->default(0);
            $table->string('start_city')->after('group_id');
            $table->string('end_city')->after('start_city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['event_name','slug','cover_image','rating','start_city','end_city']);
        });
    }
}
