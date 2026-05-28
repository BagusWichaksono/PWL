<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'stok_id' => $i,
                'supplier_id' => floor(($i - 1) / 5) + 1,
                'barang_id' => $i,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 50,
            ];
        }

        DB::table('t_stok')->insert($data);
    }
}