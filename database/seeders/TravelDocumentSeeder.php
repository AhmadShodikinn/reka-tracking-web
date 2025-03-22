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
            'no_travel_document' => '0001/001/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'Purna Jual PT INKA (Persero)',
            'po_number' => '4500000011223',
            'reference_number' => '0001/001/REKA/GEN/PPC/I/2025',
            'project' => '612 Card replacement PT KAI',
            'status' => 'terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0002/002/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'PT DUTA ATAYA ANUGERAH
                APL TOWER - CENTRAL PARK 19TH FL. UNIT T7 
                JL. Letjen S. Parman KAV 28 Grogol Petamburan Jakarta
                11470 - Indonesia
                Bu Nisa (0882-0021-41555)',
            'po_number' => '4500000011223',
            'reference_number' => '3615/205/REKA/GEN/PPC/XII/2024',
            'project' => '612',
            'status' => 'belum terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0003/003/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => '"PT MITRA BERKAH MAPAN
                RUKO PERMATA REGENCY BLOK R2 NO 14 
                TANGGULANGIN SIDOARJO
                IBU NIMAS 081234254023"
                ',
            'po_number' => '4500000011223',
            'reference_number' => '3613/203/REKA/GEN/PPC/XII/2024',
            'project' => '612',
            'status' => 'belum terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0004/004/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'CV. ROHA ELEKTRIK BERSAUDARA
                L BRIGJEND KATAMSO IV NO.9 SIDOARJO
                Bp. Samuel (081234127212)"
                ',
            'po_number' => '4500000011223',
            'reference_number' => '0003/003/REKA/GEN/PPC/I/2025',
            'project' => '612',
            'status' => 'belum terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0005/005/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'Polytron Service Center
                Jl. Urip Sumoharjo No.83, Manguharjo, Kec. Manguharjo, 
                Kota Madiun, Jawa Timur 63128
                ',
            'po_number' => '4500000011223',
            'reference_number' => '0004/005/REKA/GEN/PPC/I/2025',
            'project' => '612',
            'status' => 'belum terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0006/006/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'CV. GRAFIKA ABADI
                Jl. Raya Bandung No.15, Blok C, Bandung 40232
                Bp. Arif (081234567890)',
            'po_number' => '4500000011224',
            'reference_number' => '0005/005/REKA/GEN/PPC/I/2025',
            'project' => '613',
            'status' => 'belum terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0007/007/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'PT. KARYA SEJAHTERA
                Jl. Merdeka No.89, Jakarta Selatan 12345
                Bu. Sari (081234567891)',
            'po_number' => '4500000011225',
            'reference_number' => '0006/006/REKA/GEN/PPC/I/2025',
            'project' => '614',
            'status' => 'terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0008/008/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'PT. SINDO TEKNOLOGI
                Jl. Teknologi No.11, Surabaya 60225
                Bp. Joko (081234567892)',
            'po_number' => '4500000011226',
            'reference_number' => '0007/007/REKA/GEN/PPC/I/2025',
            'project' => '615',
            'status' => 'belum terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0009/009/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'PT. Sumber Daya Teknik
                Jl. Raya No.33, Malang 65132
                Bp. Agus (081234567893)',
            'po_number' => '4500000011227',
            'reference_number' => '0008/0008/REKA/GEN/PPC/I/2025',
            'project' => '616',
            'status' => 'belum terkirim',
        ]);

        TravelDocument::create([
            'no_travel_document' => '0010/010/REKA/I/2025',
            'date_no_travel_document' => now(),
            'send_to' => 'PT. MANFAAT BERSAMA
                Jl. Industri No.50, Jakarta Barat 11430
                Bu. Liana (081234567894)',
            'po_number' => '4500000011228',
            'reference_number' => '0009/009/REKA/GEN/PPC/I/2025',
            'project' => '617',
            'status' => 'terkirim',
        ]);

   
    }
}
