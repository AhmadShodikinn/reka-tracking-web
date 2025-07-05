<?php

namespace Database\Seeders;

use App\Models\MasterItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masterItems = [
            ['item_code' => 'ITEM001_1', 'item_name' => 'Slot Wago 715-1405', 'description' => 'Description for Slot Wago 715-1405'],
            ['item_code' => 'ITEM001_2', 'item_name' => 'Slot Wago 750-1405', 'description' => 'Description for Slot Wago 750-1405'],
            ['item_code' => 'ITEM001_3', 'item_name' => 'Slot Wago 750-1504', 'description' => 'Description for Slot Wago 750-1504'],
            ['item_code' => 'ITEM002_1', 'item_name' => 'Monitor, Touchscreen 10inch (HDMI Input)', 'description' => 'Description for Monitor, Touchscreen 10inch (HDMI Input)'],
            ['item_code' => 'ITEM002_2', 'item_name' => 'Keyboard Logitech K380', 'description' => 'Wireless Keyboard'],
            ['item_code' => 'ITEM002_3', 'item_name' => 'Mouse Logitech M330', 'description' => 'Wireless Mouse'],
            ['item_code' => 'ITEM003_1', 'item_name' => 'CCTV Camera Model A100', 'description' => 'HD CCTV Camera'],
            ['item_code' => 'ITEM004_1', 'item_name' => 'Modem 4G Huawei B311', 'description' => 'Modem 4G LTE'],
            ['item_code' => 'ITEM004_2', 'item_name' => 'Router TP-Link Archer AX50', 'description' => 'Wi-Fi 6 Router'],
            ['item_code' => 'ITEM005_1', 'item_name' => 'Laptop Dell XPS 13', 'description' => 'Laptop ultrabook'],
            ['item_code' => 'ITEM005_2', 'item_name' => 'Mouse Logitech MX Master 3', 'description' => 'Wireless Mouse'],
            ['item_code' => 'ITEM005_3', 'item_name' => 'Docking Station Lenovo ThinkPad', 'description' => 'Docking Station untuk laptop'],
            ['item_code' => 'ITEM005_4', 'item_name' => 'Headphone Sony WH-1000XM4', 'description' => 'Noise-canceling Headphone'],
            ['item_code' => 'ITEM006_1', 'item_name' => 'Projector Epson EB-X41', 'description' => 'Portable Projector'],
            ['item_code' => 'ITEM006_2', 'item_name' => 'Screen Projection 80 inch', 'description' => 'Screen Projection untuk presentasi'],
            ['item_code' => 'ITEM006_3', 'item_name' => 'Kabel HDMI 10 meter', 'description' => 'Kabel HDMI 10 meter'],
            ['item_code' => 'ITEM007_1', 'item_name' => 'Portable Speaker JBL GO 3', 'description' => 'Bluetooth speaker'],
            ['item_code' => 'ITEM008_1', 'item_name' => 'Headphones Sony WH-1000XM4', 'description' => 'Noise-canceling headphones'],
            ['item_code' => 'ITEM009_1', 'item_name' => 'Smartphone Samsung Galaxy S21', 'description' => 'Smartphone Android'],
            ['item_code' => 'ITEM010_1', 'item_name' => 'Printer Canon Pixma G2010', 'description' => 'Inkjet Printer'],
        ];

        foreach ($masterItems as $item) {
            MasterItem::firstOrCreate(['item_code' => $item['item_code']], $item);
        }
    }
}
