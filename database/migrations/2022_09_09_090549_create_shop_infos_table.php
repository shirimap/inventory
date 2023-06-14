<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_infos', function (Blueprint $table) {
            $table->id();
            $table->String('logo');
            $table->String('TIN')->nullable()->default(NULL);
            $table->string('name');
            $table->string('slogan')->nullable()->default(NULL);
            $table->string('location')->nullable()->default(NULL);
            $table->string('MainBranch')->nullable()->default(NULL);
            $table->string('address')->nullable()->default(NULL);
            $table->string('website')->nullable()->default(NULL);
            $table->string('phoneNumber')->nullable()->default(NULL);
            $table->string('mobile1')->nullable()->default(NULL);
            $table->string('mobile2')->nullable()->default(NULL);
            $table->string('mobile3')->nullable()->default(NULL);
            $table->string('AccountNumber1')->nullable()->default(NULL);
            $table->string('AccountNumber2')->nullable()->default(NULL);
            $table->string('AccountNumber3')->nullable()->default(NULL);
            $table->string('email')->nullable()->default(NULL);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable()->default(NULL);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_infos');
    }
}
