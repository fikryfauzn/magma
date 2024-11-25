<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreate extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the mechanic_id column
            $table->dropColumn('mechanic_id');
            
            // Add mechanic_name column to store the mechanic's name
            $table->string('mechanic_name')->nullable(); // Store mechanic's name
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the mechanic_name column and restore mechanic_id
            $table->dropColumn('mechanic_name');
            
            // Re-add mechanic_id column (foreign key to mechanic_profile table)
            $table->unsignedBigInteger('mechanic_id')->nullable(); 

            // Optionally, add foreign key constraint back if needed
            // $table->foreign('mechanic_id')->references('mechanic_id')->on('mechanic_profile')->onDelete('set null');
        });
    }
}
