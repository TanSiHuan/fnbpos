<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuHdr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MenuHDR', function (Blueprint $table) {
            $table->increments('MenuHDR_id');
            $table->string('MenuHDR_description');
            $table->string('branch_id');
            $table->time('MenuHDR_startAt');
            $table->time('MenuHDR_endAt');
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
