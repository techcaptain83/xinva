<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
            'name' => 'sjhdfbvgshb',
            'slug' => 'sdhfgasdh',
            'stripe_plan' => 'price_1Lojandojnas',
            'price' => 10,
            'description' => 'sdjghcfdhu'
            ],

            [
            'name' => 'Premiyum',
            'slug' => 'Premiyum',
            'stripe_plan' => 'price_1Lojandojnas',
            'price' => 20,
            'description' => 'sdjghcfdhu'
            ],
        ];
        foreach ($plans as $plan){
            Plan::create($plans);
        }
    }
}
