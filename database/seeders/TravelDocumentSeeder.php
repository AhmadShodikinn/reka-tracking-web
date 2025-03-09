<?php

namespace Database\Seeders;

use App\Models\TravelDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   
        TravelDocument::create([
            'no_travel_document' => 'TD001',
            'date_no_travel_document' => now(),
            'send_to' => 'Jakarta',
            'po_number' => 'PO123',
            'reference_number' => 'REF001',
            'project' => 'Project X',
            'status' => 'terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => 'TD002',
            'date_no_travel_document' => now(),
            'send_to' => 'Surabaya',
            'po_number' => 'PO124',
            'reference_number' => 'REF002',
            'project' => 'Project Y',
            'status' => 'belum terkirim',
        ]);
   
    }
}
