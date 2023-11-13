<?php

namespace Database\Seeders;

use App\Models\MoneyTransfer;
use Illuminate\Database\Seeder;

class MoneyTransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MoneyTransfer::factory()->count(5)->create();
    }
}
