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
            $table->string('user_id');
            $table->integer('company_id');
            $table->integer('car_id');
            $table->string('plate_number');
            $table->string('engine_number');
            $table->string('fuel_id');
            $table->integer('body_id');
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');
            $table->string('updated_by');
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
