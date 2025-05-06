<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HakAkses;

class HakAksesSeeder extends Seeder
{
    public function run(): void
    {
        HakAkses::insert([
            [
                'id' => 1,
                'email' => 'akses1@example.com',
                'link' => 'https://link1.com',
                'no_wa' => '081234567891',
            ],
            [
                'id' => 2,
                'email' => 'akses2@example.com',
                'link' => 'https://link2.com',
                'no_wa' => '082345678912',
            ],
        ]);
    }
}
