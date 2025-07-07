<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'contact_name'     => 'Default',
                'company_name'     => 'Purna Jual PT INKA (Persero)',
                'company_email'    => 'purnajual@inka.co.id',
                'company_phone'    => '0351-123456',
                'company_address'  => 'Jl. Yos Sudarso No. 1, Madiun',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'PT DUTA ATAYA ANUGERAH',
                'company_email'    => 'info@dutaataya.co.id',
                'company_phone'    => '021-8765432',
                'company_address'  => 'Jl. Gatot Subroto No. 10, Jakarta',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'PT MITRA BERKAH MAPAN',
                'company_email'    => 'mitra@berkahmapan.co.id',
                'company_phone'    => '031-3344556',
                'company_address'  => 'Jl. Panglima Sudirman No. 3, Surabaya',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'CV. ROHA ELEKTRIK BERSAUDARA',
                'company_email'    => 'rohaelektrik@gmail.com',
                'company_phone'    => '0271-223344',
                'company_address'  => 'Jl. Slamet Riyadi No. 45, Solo',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'Polytron Service Center',
                'company_email'    => 'service@polytron.co.id',
                'company_phone'    => '024-556677',
                'company_address'  => 'Jl. Imam Bonjol No. 88, Semarang',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'CV. GRAFIKA ABADI',
                'company_email'    => 'grafika@abadi.co.id',
                'company_phone'    => '022-998877',
                'company_address'  => 'Jl. Asia Afrika No. 123, Bandung',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'PT. KARYA SEJAHTERA',
                'company_email'    => 'karya@sejahtera.co.id',
                'company_phone'    => '031-7654321',
                'company_address'  => 'Jl. Rajawali No. 21, Surabaya',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'PT. SINDO TEKNOLOGI',
                'company_email'    => 'contact@sindotek.co.id',
                'company_phone'    => '021-332211',
                'company_address'  => 'Jl. Panjang No. 9, Jakarta',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'PT. Sumber Daya Teknik',
                'company_email'    => 'sumber@dayateknik.co.id',
                'company_phone'    => '0251-443322',
                'company_address'  => 'Jl. Ahmad Yani No. 4, Bogor',
            ],
            [
                'contact_name'     => 'Default',
                'company_name'     => 'PT. MANFAAT BERSAMA',
                'company_email'    => 'manfaat@bersama.co.id',
                'company_phone'    => '0361-112233',
                'company_address'  => 'Jl. Raya Kuta No. 17, Bali',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['company_name' => $partner['company_name']],
                $partner
            );
        }
    }
}
