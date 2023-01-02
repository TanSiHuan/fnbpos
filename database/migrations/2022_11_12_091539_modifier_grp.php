<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifierGrp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifier_grp', function (Blueprint $table) {
            $table->string('modifier_grp_code')->primary();
            $table->string('modifier_grp_description');
            $table->string('branch_id');
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
