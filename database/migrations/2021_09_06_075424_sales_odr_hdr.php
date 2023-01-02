<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesOdrHdr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SalesOdrHdr', function (Blueprint $table) {
            $table->string('SaleOdrHdr_id')->primary();
            $table->decimal('SaleOdrHdr_total',14);
            $table->string('SaleOdrHdr_paymentMethod');
            $table->string('SaleOdrHdr_status');
            $table->string('SaleOdrHdr_active');
            $table->string('SaleOdrHdr_createBy');
            $table->string('SaleOdrHdr_updateBy');
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
