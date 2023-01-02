<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemSpecification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ItemSpecification', function (Blueprint $table) {
            $table->string('itemSpec_id')->primary();
            $table->string('itemSpec_description');
            $table->decimal('itemSpec_price',14);
            $table->string('itemSpec_itemID');
            $table->string('itemSpec_createBy');
            $table->string('itemSpec_active');
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
        //
    }
}
