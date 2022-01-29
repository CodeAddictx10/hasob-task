<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('serial_no');
            $table->text('description');
            $table->string('fixed_or_movable');
            $table->string('picture_path');
            $table->string('purchase_date', 10);
            $table->string('start_to_use_date', 10);
            $table->double('purchase_price');
            $table->string('warranty_expiry_date', 10);
            $table->integer('degradation_in_years');
            $table->double('current_value_in_naira');
            $table->string('location');
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
        Schema::dropIfExists('assets');
    }
}
