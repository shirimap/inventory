<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->String('customer_name')->nullable()->default(NULL);
            $table->String('address')->nullable()->default(NULL);
            $table->String('phonenumber')->nullable()->default(NULL);
            $table->String('TIN')->nullable()->default(NULL);
            $table->String('VRN')->nullable()->default(NULL);
            $table->float('org_amount');
            $table->float('total_amount');
            $table->float('discount');
            $table->bigInteger('vat')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
