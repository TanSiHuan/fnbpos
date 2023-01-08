<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuDtl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MenuDtl', function (Blueprint $table) {
            $table->increments('MenuDtl_id');
            $table->string('MenuHDR_id');
            $table->string('MenuDtl_itemID');
            $table->string('MenuDtl_description');
            $table->string('category_code');
            $table->string('modifier_grp_code')->nullable();
            $table->decimal('MenuDtl_price',14);
            $table->string('MenuHDR_createBy'); //restaurant
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
