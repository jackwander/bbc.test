<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertAddressContactnumAndCoverImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cover_image',255)->after('position');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('location_id')->on('locations')->onDelete('cascade');
            $table->string('contactnum',50)->after('location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('location_id');            
            $table->dropColumn('cover_image');            
            $table->dropColumn('contactnum');            
        });
    }
}
