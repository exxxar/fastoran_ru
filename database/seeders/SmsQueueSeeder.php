<?php

namespace Database\Seeders;

use App\Models\SmsQueue;
use Illuminate\Database\Seeder;

class SmsQueueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmsQueue::factory()->count(5)->create();
    }
}
