<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->String('customer_name')->nullable()->default(NULL);
            $table->String('address')->nullable()->default(NULL);
            $table->String('phonenumber')->nullable()->default(NULL);
            $table->String('TIN')->nullable()->default(NULL);
            $table->String('VRN')->nullable()->default(NULL);
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->float('discount')->default(0);
            $table->float('quantity');
            $table->float('total_amount');
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
        Schema::dropIfExists('sells');
    }
}
