<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesOdrDtl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SalesOdrDtl', function (Blueprint $table) {
            $table->string('SalesOdrDtl_id')->primary();
            $table->string('SalesOdrHdr_id');
            $table->string('SalesOdrDtl_item');
            $table->integer('SalesOdrDtl_itemQty');
            $table->decimal('SalesOdrDtl_price');
            $table->decimal('SalesOdrDtl_total');
            $table->string('SalesOdrDtl_active');
            $table->string('SalesOdrDtl_status');
            $table->string('SalesOdrDtl_createBy');
            $table->string('SalesOdrDtl_updateBy');
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
