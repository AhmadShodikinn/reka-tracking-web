<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\Preorder;
use App\Models\Projects;
use App\Models\TravelDocument;
use Illuminate\Database\Seeder;

class PreorderSeeder extends Seeder
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
            ]
        ];

        foreach ($documents as $doc) {
            $partner = Partner::where('company_name', $doc['partner'])->first();
            $project = Projects::where('project_code', $doc['project_code'])->first();

            $preorder = Preorder::firstOrCreate(
                ['po_number' => $doc['po_number']],
                [
                    'partner_id' => $partner ? $partner->id : null,
                    'project_id' => $project ? $project->id : null,
                ]
            );
            
            if ($partner && $project && $preorder) {
                TravelDocument::create([
                    'no_travel_document' => $doc['no_travel_document'],
                    'date_no_travel_document' => now(),
                    'send_to_id' => $partner->id,
                    'preorder_id' => $preorder->id,
                    'reference_number' => $doc['reference_number'],
                    'project_id' => $project->id,
                    'status' => $doc['status'],
                ]);
            }
        }

    }
}
