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
            $table->string('name');
            $table->string('phone');
            $table->string('ad_phone')->nullable();
            $table->unsignedInteger('admin_id');
            $table->string('address')->nullable();
            $table->string('status');
            $table->unsignedInteger('deliverymethod_id')->nullable();
            $table->unsignedInteger('delivery_id')->nullable();
            $table->longText('comments')->nullable();
            $table->string('product');
            $table->string('area');
            $table->unsignedInteger('grand_total')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('discount')->nullable();
            $table->unsignedInteger('shipping_charge')->nullable();
            $table->unsignedBigInteger('total')->nullable();
            $table->string('delivery_method_type');
            $table->string('order_number')->nullable();
            $table->softDeletes();
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
