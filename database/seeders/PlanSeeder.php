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
    public function run()
    {
        Plan::firstOrCreate([
            'name' => 'Gratuito',
        ], [
            'daily_limit' => 1000,
            'price' => 0.00,
        ]);

        Plan::firstOrCreate([
            'name' => 'Pro',
        ], [
            'daily_limit' => 5000,
            'price' => 30.00,
        ]);

        Plan::firstOrCreate([
            'name' => 'Empresarial',
        ], [
            'daily_limit' => -1,
            'price' => 50.00,
        ]);
    }
}
