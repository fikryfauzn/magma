<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPaymentMethodFromTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Drop the payment_method column
            $table->dropColumn('payment_method');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Add payment_method column back, in case you need to rollback
            $table->string('payment_method')->nullable();
        });
    }
}
