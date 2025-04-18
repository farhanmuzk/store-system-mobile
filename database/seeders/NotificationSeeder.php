<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'token' => Str::uuid(),
            'notification_time' => now(),
            'admin_id' => null,
            'image' => null,
        ]);
    }
}
