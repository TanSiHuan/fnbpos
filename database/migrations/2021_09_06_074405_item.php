<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Item extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Item', function (Blueprint $table) {
            $table->string('item_code')->primary();
            $table->string('item_description');
            $table->string('item_type');
            $table->decimal('item_ref_price',14);
            $table->string('item_category');
            $table->string('item_active');
            $table->string('create_by');
            $table->string('item_img');
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
