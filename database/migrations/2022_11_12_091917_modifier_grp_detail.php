<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifierGrpDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifier_grp_detail', function (Blueprint $table) {
            $table->string('modifier_grp_detail_id')->primary();
            $table->string('modifier_grp_code');
            $table->string('modifier_code');
            $table->string('modifier_grp_detail_price');
            $table->string('modifier_grp_detail_createBy');
            $table->string('modifier_grp_detail_active');
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
