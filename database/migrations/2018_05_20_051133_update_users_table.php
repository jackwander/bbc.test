<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 150)->change();
            $table->string('mname',150)->after('name');
            $table->string('lname',150)->after('mname');
            $table->renameColumn('name', 'fname');
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
            $table->string('fname', 191)->change();
            $table->dropColumn('mname');
            $table->dropColumn('lname');
            $table->renameColumn('fname', 'name'); 
        });
    }
}
