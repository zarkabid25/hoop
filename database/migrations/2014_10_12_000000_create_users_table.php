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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('company_type')->nullable();
            $table->string('referred')->nullable();
            $table->string('email')->unique();
            $table->string('alternate_email')->nullable();
            $table->string('role');
            $table->bigInteger('phone')->nullable();
            $table->bigInteger('alternate_phone')->nullable();
            $table->string('address')->nullable();
            $table->text('comment')->nullable();
            $table->string('image', 150)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
