<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcfs', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->timestamp('order_time')->nullable();
            $table->timestamp('order_completed_time')->nullable();
            $table->timestamp('customer_left_time')->nullable();
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
        Schema::dropIfExists('fcfs');
    }
}
