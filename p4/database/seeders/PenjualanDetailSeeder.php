<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        $detail_id = 1;
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $data[] = [
                    'detail_id' => $detail_id,
                    'penjualan_id' => $i,
                    'barang_id' => rand(1, 15),
                    'harga' => 15000,
                    'jumlah' => 2,
                ];
                $detail_id++;
            }
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
}