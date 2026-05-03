<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            ['name' => 'KirimAja Jakarta Pusat', 'city' => 'Jakarta', 'address' => 'Jl. Sudirman No. 45, Jakarta Pusat', 'phone' => '021-5551001'],
            ['name' => 'KirimAja Bandung', 'city' => 'Bandung', 'address' => 'Jl. Asia Afrika No. 12, Bandung', 'phone' => '022-5552002'],
            ['name' => 'KirimAja Surabaya', 'city' => 'Surabaya', 'address' => 'Jl. Pemuda No. 33, Surabaya', 'phone' => '031-5553003'],
            ['name' => 'KirimAja Yogyakarta', 'city' => 'Yogyakarta', 'address' => 'Jl. Malioboro No. 88, Yogyakarta', 'phone' => '0274-5554004'],
            ['name' => 'KirimAja Semarang', 'city' => 'Semarang', 'address' => 'Jl. Pandanaran No. 21, Semarang', 'phone' => '024-5555005'],
            ['name' => 'KirimAja Medan', 'city' => 'Medan', 'address' => 'Jl. Gatot Subroto No. 77, Medan', 'phone' => '061-5556006'],
            ['name' => 'KirimAja Makassar', 'city' => 'Makassar', 'address' => 'Jl. Ratulangi No. 55, Makassar', 'phone' => '0411-5557007'],
            ['name' => 'KirimAja Palembang', 'city' => 'Palembang', 'address' => 'Jl. Jenderal Sudirman No. 10, Palembang', 'phone' => '0711-5558008'],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
