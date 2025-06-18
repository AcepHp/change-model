<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CsChangeModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cs_changemodel')->insert([
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 3, 'station' => 'ST. 5', 'check_item' => 'Kesesuaian Applique & LCD', 'standard' => 'Applique R = FB', 'actual' => 'scan', 'trigger' => 'LTHB',
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 4, 'station' => 'ST. 5', 'check_item' => 'Kesesuaian Applique & LCD', 'standard' => 'LCD : STD', 'actual' => 'scan', 'trigger' => 'LTHB',
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 5, 'station' => 'ST. 5', 'check_item' => 'Pencegahan part tercampur', 'standard' => 'Tidak ada part tipe lain di line produksi', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 6, 'station' => 'ST. 10', 'check_item' => 'Work Order', 'standard' => 'WO-K1ZVNAMB-YJ-BRADY-2503', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 7, 'station' => 'ST. 10', 'check_item' => 'Program Mesin', 'standard' => 'VPST8F-10849-GD-1', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 8, 'station' => 'ST. 10', 'check_item' => 'Label barcode', 'standard' => 'scan barcode muncul part no = kunci "K1ZVNAMB"', 'actual' => 'scan', 'trigger' => "LTHB",
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 9, 'station' => 'ST. 10', 'check_item' => 'Label barcode', 'standard' => 'D1K1ZNAA', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 10, 'station' => 'ST. 10', 'check_item' => 'Label barcode', 'standard' => 'VISTEON', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 11, 'station' => 'ST. 10', 'check_item' => 'Label barcode', 'standard' => '3710-K1Z-NA11-C1', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 12, 'station' => 'ST. 10', 'check_item' => 'Label barcode', 'standard' => 'VPST8F-10849-GD', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 13, 'station' => 'ST. 10', 'check_item' => 'Label barcode', 'standard' => 'MADE IN INDONESIA', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 14, 'station' => 'ST. 10', 'check_item' => 'Label barcode', 'standard' => 'Tanggal Produksi', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 15, 'station' => 'ST. 10', 'check_item' => 'Label barcode', 'standard' => 'Jam Produksi', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 16, 'station' => 'ST. 10', 'check_item' => 'Pencegahan part tercampur', 'standard' => 'Tidak ada PWBA tipe lain di line produksi', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 17, 'station' => 'ST. 15', 'check_item' => 'Rearcover Assy', 'standard' => 'Nut Spring tersedia di ST.15', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 18, 'station' => 'ST. 15', 'check_item' => 'Program Mesin', 'standard' => '10', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 19, 'station' => 'ST. 15', 'check_item' => 'Filter vent', 'standard' => 'Warna Putih', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 20, 'station' => 'ST.25a', 'check_item' => 'Mesin auto Rearcover', 'standard' => 'Mesin aktif', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 21, 'station' => 'ST.25b', 'check_item' => 'Mesin auto screw Lens', 'standard' => 'Mesin aktif', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 22, 'station' => 'ST.30', 'check_item' => 'Program Mesin', 'standard' => 'EOL 1 Version 20250325 K1ZVNAMB', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 23, 'station' => 'ST.30', 'check_item' => 'Sensor screw', 'standard' => 'Screw lens aktif & Rear cover aktif', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 24, 'station' => 'ST.30', 'check_item' => 'Program Mesin', 'standard' => 'EOL 2 Version 20250325 K1ZVNAMB', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 25, 'station' => 'ST.30', 'check_item' => 'Sensor screw', 'standard' => 'Screw lens aktif & Rear cover aktif', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 26, 'station' => 'ST.35', 'check_item' => 'Program Mesin', 'standard' => 'PDI Version 20250325 K1ZVNAMB', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 27, 'station' => 'ST. Rework', 'check_item' => 'Pencegahan part tercampur', 'standard' => 'Tidak ada part selain tipe yang sedang berjalan di', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 28, 'station' => 'Tag produk', 'check_item' => 'Warna tag produk', 'standard' => 'Biru', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 29, 'station' => 'Tag produk', 'check_item' => 'Kesesuaian tag produk & PACO', 'standard' => 'Kode tag produk : K1Z-NA', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 30, 'station' => 'Tag produk', 'check_item' => 'Kesesuaian tag produk & PACO', 'standard' => 'Kode tag produk : K1Z-VNAM', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'FA', 'line' => 5, 'model' => 'FSST8F010849-GD0M', 'list' => 31, 'station' => 'Tag produk', 'check_item' => 'Kesesuaian tag produk & PACO', 'standard' => 'Kode tag produk : K1Z-VNAM', 'actual' => 'check', 'trigger' => null,
            ],
            [
                'area' => 'ZZ', 'line' => 77, 'model' => 'TEST-ACEP', 'list' => 31, 'station' => 'AcepTest', 'check_item' => 'AcepTest', 'standard' => 'AcepTest', 'actual' => 'scan', 'trigger' => 'LTFB',
            ],
            [
                'area' => 'ZZ', 'line' => 77, 'model' => 'TEST-ACEP', 'list' => 31, 'station' => 'AcepTest', 'check_item' => 'AcepTest', 'standard' => 'AcepTest', 'actual' => 'scan', 'trigger' => 'CCVN',
            ],
            [
                'area' => 'ZZ', 'line' => 77, 'model' => 'TEST-ACEP', 'list' => 31, 'station' => 'AcepTest', 'check_item' => 'AcepTest', 'standard' => 'AcepTest', 'actual' => 'check', 'trigger' => null,
            ],
            
        ]);
    }
}
