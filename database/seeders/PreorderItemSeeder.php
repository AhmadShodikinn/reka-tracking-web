<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Preorder;
use App\Models\PreorderItem;
use App\Models\MasterItem;
use App\Models\Unit;

class PreorderItemSeeder extends Seeder
{
    public function run(): void
    {
        $preorders = Preorder::take(2)->get();
        $items = MasterItem::inRandomOrder()->take(5)->get();
        $units = Unit::inRandomOrder()->take(2)->pluck('id');

        foreach ($preorders as $preorder) {
            foreach ($items->shuffle()->take(3) as $item) {
                PreorderItem::create([
                    'preorder_id'     => $preorder->id,
                    'master_item_id'  => $item->id,
                    'unit_id'         => $units->random(),
                    'qty_po'          => rand(5, 20),
                    'information'     => fake()->sentence(3),
                ]);
            }
        }
    }
}
