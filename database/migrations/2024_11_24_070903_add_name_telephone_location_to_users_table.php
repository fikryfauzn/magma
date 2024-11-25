<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameTelephoneLocationToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('username')->nullable(); // Adds the name column after the username column
            $table->string('telephone_number')->after('email')->nullable(); // Adds telephone number after email
            $table->string('location')->after('password')->nullable(); // Adds location after the password column
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('telephone_number');
            $table->dropColumn('location');
        });
    }
}
