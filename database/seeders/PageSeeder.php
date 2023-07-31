<?php

namespace Database\Seeders;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'name' => 'Privacy policy',
            'title' => 'Privacy policy',
            'meta_description' => 'Privacy policy',
            'content' => 'Page content',
        ]);
    }
}
