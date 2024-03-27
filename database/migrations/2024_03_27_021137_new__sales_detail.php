<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewSalesDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_salesdetail', function (Blueprint $table) {
            $table->increments('id_sales_detail');
            $table->integer('id_sales');
            $table->integer('id_product');
            $table->integer('price_sell');
            $table->integer('sum');
            $table->tinyInteger('discount')->default(0);
            $table->integer('subtotal');
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
        Schema::dropIfExists('new_salesdetail');
    }
}
