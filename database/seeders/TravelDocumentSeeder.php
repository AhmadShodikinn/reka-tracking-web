<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\Project;
use App\Models\Projects;
use App\Models\TravelDocument;
use Illuminate\Database\Seeder;

class TravelDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'no_travel_document' => '0001/001/REKA/I/2025',
                'partner' => 'Purna Jual PT INKA (Persero)',
                'po_number' => '4500000011223',
                'reference_number' => '0001/001/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0002/002/REKA/I/2025',
                'partner' => 'PT DUTA ATAYA ANUGERAH',
                'po_number' => '4500000011223',
                'reference_number' => '3615/205/REKA/GEN/PPC/XII/2024',
                'project_code' => '612',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0003/003/REKA/I/2025',
                'partner' => 'PT MITRA BERKAH MAPAN',
                'po_number' => '4500000011223',
                'reference_number' => '3613/203/REKA/GEN/PPC/XII/2024',
                'project_code' => '612',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0004/004/REKA/I/2025',
                'partner' => 'CV. ROHA ELEKTRIK BERSAUDARA',
                'po_number' => '4500000011223',
                'reference_number' => '0003/003/REKA/GEN/PPC/I/2025',
                'project_code' => '612',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0005/005/REKA/I/2025',
                'partner' => 'Polytron Service Center',
                'po_number' => '4500000011223',
                'reference_number' => '0004/005/REKA/GEN/PPC/I/2025',
                'project_code' => '612',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0006/006/REKA/I/2025',
                'partner' => 'CV. GRAFIKA ABADI',
                'po_number' => '4500000011224',
                'reference_number' => '0005/005/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0007/007/REKA/I/2025',
                'partner' => 'PT. KARYA SEJAHTERA',
                'po_number' => '4500000011225',
                'reference_number' => '0006/006/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0008/008/REKA/I/2025',
                'partner' => 'PT. SINDO TEKNOLOGI',
                'po_number' => '4500000011226',
                'reference_number' => '0007/007/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'belum terkirim',
            ],
            [
                'no_travel_document' => '0009/009/REKA/I/2025',
                'partner' => 'PT. Sumber Daya Teknik',
                'po_number' => '4500000011227',
                'reference_number' => '0008/0008/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'belum terkirim',
            ],
            [
                'no_travel_document' => '0010/010/REKA/I/2025',
                'partner' => 'PT. MANFAAT BERSAMA',
                'po_number' => '4500000011228',
                'reference_number' => '0009/009/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'belum terkirim',
            ],
        ];

        foreach ($documents as $doc) {
            $partner = Partner::where('company_name', $doc['partner'])->first();
            $project = Projects::where('project_code', $doc['project_code'])->first();

            if ($partner && $project) {
                TravelDocument::create([
                    'no_travel_document' => $doc['no_travel_document'],
                    'date_no_travel_document' => now(),
                    'send_to_id' => $partner->id,
                    'po_number' => $doc['po_number'],
                    'reference_number' => $doc['reference_number'],
                    'project_id' => $project->id,
                    'status' => $doc['status'],
                ]);
            }
        }
    }
}
