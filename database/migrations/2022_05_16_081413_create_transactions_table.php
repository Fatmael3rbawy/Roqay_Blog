<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('invoice_url')->nullable();
            $table->string('invoice_reference')->nullable();
            $table->string('created_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('expiry_time')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('invoice_display_value')->nullable();

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
        Schema::dropIfExists('transactions');
    }
}
