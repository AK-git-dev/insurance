<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTempRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temp_rides', function (Blueprint $table) {
            $table->string('start_city')->after('end_location');
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
        Schema::table('temp_rides', function (Blueprint $table) {
            $table->dropColumn(['start_city','end_city']);
        });
    }
}
