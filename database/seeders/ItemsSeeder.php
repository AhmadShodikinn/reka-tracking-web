<?php

namespace Database\Seeders;

use App\Models\Items;
use App\Models\TravelDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;   
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $travelDocument1 = TravelDocument::where('no_travel_document', 'TD001')->first();
        $travelDocument2 = TravelDocument::where('no_travel_document', 'TD002')->first();

        // Menambahkan Item
        Items::create([
            'travel_document_id' => $travelDocument1->id,
            'item_code' => 'ITEM001',
            'item_name' => 'Item 1',
            'qty_send' => 100,
            'total_send' => 120,
            'qty_po' => 100,
            'description' => 'Description for item 1',
        ]);

        Items::create([
            'travel_document_id' => $travelDocument2->id,
            'item_code' => 'ITEM002',
            'item_name' => 'Item 2',
            'qty_send' => 150,
            'total_send' => 170,
            'qty_po' => 150,
            'description' => 'Description for item 2',
        ]);
    }
}
