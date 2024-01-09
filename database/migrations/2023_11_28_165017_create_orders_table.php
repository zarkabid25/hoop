<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->after('id');
            $table->string('design_name')->nullable();
            $table->string('fabric')->nullable();
            $table->string('placement')->nullable();
            $table->string('format')->nullable();
            $table->integer('no_color')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('digitiz_order_img')->nullable();
            $table->string('urgent')->nullable();
            $table->string('price')->nullable();
            $table->string('color_type')->nullable();
            $table->string('vector_order_img')->nullable();
            $table->string('patch_type')->nullable();
            $table->string('patch_order_img')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('tracking_id')->nullable();
            $table->string('logo_order_img')->nullable();
            $table->text('special_instruct')->nullable();
            $table->string('order_type')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
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
};
