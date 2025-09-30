<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\Preorder;
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
                'reference_number' => '0001/001/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0002/002/REKA/I/2025',
                'partner' => 'PT DUTA ATAYA ANUGERAH',
                'reference_number' => '3615/205/REKA/GEN/PPC/XII/2024',
                'project_code' => '612',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0003/003/REKA/I/2025',
                'partner' => 'PT MITRA BERKAH MAPAN',
                'reference_number' => '3613/203/REKA/GEN/PPC/XII/2024',
                'project_code' => '612',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0004/004/REKA/I/2025',
                'partner' => 'CV. ROHA ELEKTRIK BERSAUDARA',
                'reference_number' => '0003/003/REKA/GEN/PPC/I/2025',
                'project_code' => '612',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0005/005/REKA/I/2025',
                'partner' => 'Polytron Service Center',
                'reference_number' => '0004/005/REKA/GEN/PPC/I/2025',
                'project_code' => '612',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0006/006/REKA/I/2025',
                'partner' => 'CV. GRAFIKA ABADI',
                'reference_number' => '0005/005/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0007/007/REKA/I/2025',
                'partner' => 'PT. KARYA SEJAHTERA',
                'reference_number' => '0006/006/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'terkirim',
            ],
            [
                'no_travel_document' => '0008/008/REKA/I/2025',
                'partner' => 'PT. SINDO TEKNOLOGI',
                'reference_number' => '0007/007/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'belum terkirim',
            ],
            [
                'no_travel_document' => '0009/009/REKA/I/2025',
                'partner' => 'PT. Sumber Daya Teknik',
                'reference_number' => '0008/0008/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'belum terkirim',
            ],
            [
                'no_travel_document' => '0010/010/REKA/I/2025',
                'partner' => 'PT. MANFAAT BERSAMA',
                'reference_number' => '0009/009/REKA/GEN/PPC/I/2025',
                'project_code' => '612-CR',
                'status' => 'belum terkirim',
            ],
        ];

        foreach ($documents as $index => $doc) {
            $partner = Partner::where('company_name', $doc['partner'])->first();
            $project = Projects::where('project_code', $doc['project_code'])->first();

            if ($partner && $project) {
                $data = [
                    'no_travel_document' => $doc['no_travel_document'],
                    'date_no_travel_document' => now(),
                    'send_to_id' => $partner->id,
                    'reference_number' => $doc['reference_number'],
                    'project_id' => $project->id,
                    'status' => $doc['status'],
                ];

                if ($index < 2) {
                    $preorder = Preorder::where('po_number', '4500000011223')->first();
                    $data['preorder_id'] = $preorder?->id;
                }

                TravelDocument::create($data);
            }
        }
    }
}
