<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FutureWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('future_work')->insert([
            'must_do' => '- ',         // Công việc Phải làm
            'want_to_do' => '- ',     // Muốn làm
            'need_to_do' => '- ',   // Cần làm
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
