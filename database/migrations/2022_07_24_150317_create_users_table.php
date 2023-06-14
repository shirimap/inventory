<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->String('phone');
            $table->string('address');
            $table->string('gender');
            $table->boolean('status')->default(1);
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('cascade');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable()->default(NULL);
            $table->dateTime('last_login')->nullable()->default(null);

            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
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
}
