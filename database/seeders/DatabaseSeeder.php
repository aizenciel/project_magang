<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Create sample items
        $items = [
            [
                'item_code' => 'G0000001',
                'inc' => '3476.0',
                'item_type' => 'Material General',
                'item_group' => 'Tools',
                'uom' => 'Pcs',
                'denotation' => '15 mm Chrome Vanadium Combinationspanner',
                'key_word' => 'WRENCH,SPANNER',
                'description' => 'WRENCH:TYPE:SPANNER;SIZE:15MM;POINT QUANTITY:6PT;MATERIAL:CHROMIUM-VANADIUM STEEL;SURFACE TREATMENT: SATIN CHROME',
                'old_code' => 'TOOL-027-A',
                'unit_price' => 75000.0,
                'main_supplier' => 'PT Tekiro Global',
                'storage_location' => 'Tools Warehouse',
                'max_stock_level' => 0.0,
                'reorder_point' => 0.0,
            ],
            [
                'item_code' => 'E0000001',
                'inc' => '10957.0',
                'item_type' => 'Material OEM',
                'item_group' => 'Spare Parts',
                'uom' => 'Pcs',
                'denotation' => 'Actuator RR / Actuator Belakang PN : 364100K020',
                'key_word' => 'ACTUATOR,ELECTRO-MECHANICAL,LINEAR',
                'description' => 'ACTUATOR,M/E:BRAND: CUMMINS;PARTS NUMBER: 364100K020',
                'old_code' => 'SP-014-P',
                'unit_price' => 3450000.0,
                'main_supplier' => 'PT Powergen Maju',
                'storage_location' => 'Spare Parts Warehouse',
                'max_stock_level' => 8.0,
                'reorder_point' => 6.0,
            ],
            [
                'item_code' => 'S0000001',
                'inc' => '0.0',
                'item_type' => 'Services',
                'item_group' => 'Barge Services',
                'uom' => 'MT',
                'denotation' => 'Sewa Tongkang',
                'key_word' => 'TRANSPORT, DOMESTIC BARGE TRANSPORT SERVICES',
                'description' => 'TRANSPORT,DOM BARGE : SERVICE TYPE: ORE BARGE;ACTIVITY: SHIPMENT;ORIGIN: JETTY;DESTINATION: IWIP',
                'old_code' => '100008',
                'unit_price' => 450000000.0,
                'main_supplier' => 'PT Samudera Pasti',
                'storage_location' => '',
                'max_stock_level' => 0.0,
                'reorder_point' => 0.0,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
