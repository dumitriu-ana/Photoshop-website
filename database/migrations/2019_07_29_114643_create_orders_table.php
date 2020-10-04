<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_username');
            $table->integer('img_nr');
            $table->string('files_path')->nullable();
            $table->string('notes');
            $table->string('format')->nullable();
            $table->boolean('background');
            $table->boolean('eps');
            $table->integer('resolution_change');
            $table->integer('res_x')->nullable();
            $table->integer('res_y')->nullable();
            $table->integer('rgb_to_cmyk');
            $table->integer('price')->nullable();
            $table->integer('free_trial')->default(0);
            $table->integer('ready')->default(0);

            $table->boolean('confirmed');
            $table->timestamp('finished_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
