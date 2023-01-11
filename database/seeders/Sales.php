<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\Cast\Double;

class Sales extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salesodrdtl')->insert([
            'SalesOdrHdr_id' => Str::random(10),
            'SalesOdrDtl_item' => Str::random(10),
            'SalesOrderDtl_itemQty' => Int::random(10),
            'SalesOdrDtl_price' => Double::random(10),
            'SalesOdrDtl_total' => Double::random(10),
            'SalesOdrDtl_active' => 'yes',
            'SalesOdrDtl_status' => 'done'
        ]);
    }
}
