<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modifier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifier', function (Blueprint $table) {
            $table->string('modifier_code')->primary();
            $table->string('modifier_description');
            $table->decimal('modifier_ref_price',14);
            $table->string('modifier_createBy');
            $table->string('modifier_active');
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
