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
        Schema::create('placements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('bags', 30)->nullable();
            $table->string('cap', 30)->nullable();
            $table->string('chest', 30)->nullable();
            $table->string('gloves', 30)->nullable();
            $table->string('cap_side', 30)->nullable();
            $table->string('cap_back', 30)->nullable();
            $table->string('towel', 30)->nullable();
            $table->string('jacketback', 30)->nullable();
            $table->string('sleeve', 30)->nullable();
            $table->string('patches', 30)->nullable();
            $table->string('visor', 30)->nullable();
            $table->string('table_cloth', 30)->nullable();
            $table->string('beanie_caps', 30)->nullable();
            $table->string('apron', 30)->nullable();
            $table->string('other', 30)->nullable();
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
        Schema::dropIfExists('placements');
    }
};
