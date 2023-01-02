<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoginHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LoginHistory', function (Blueprint $table) {
            $table->string('LH_ID')->primary();
            $table->string('LH_staffID');
            $table->string('LH_LoginTime');
            $table->string('LH_LogoutTime');
            $table->string('LH_Restaurant');
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
