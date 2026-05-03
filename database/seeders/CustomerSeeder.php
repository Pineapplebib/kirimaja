<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['name' => 'Ahmad Fauzi', 'email' => 'ahmad@example.com', 'password' => Hash::make('password'), 'phone' => '081234567890', 'address' => 'Jl. Kebayoran Baru No. 5', 'city' => 'Jakarta'],
            ['name' => 'Siti Rahayu', 'email' => 'siti@example.com', 'password' => Hash::make('password'), 'phone' => '082345678901', 'address' => 'Jl. Dago No. 22', 'city' => 'Bandung'],
            ['name' => 'Budi Prakoso', 'email' => 'budi@example.com', 'password' => Hash::make('password'), 'phone' => '083456789012', 'address' => 'Jl. Rungkut No. 10', 'city' => 'Surabaya'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'password' => Hash::make('password'), 'phone' => '084567890123', 'address' => 'Jl. Kaliurang No. 15', 'city' => 'Yogyakarta'],
            ['name' => 'Eko Prasetyo', 'email' => 'eko@example.com', 'password' => Hash::make('password'), 'phone' => '085678901234', 'address' => 'Jl. Pemuda No. 7', 'city' => 'Semarang'],
            ['name' => 'Fitri Handayani', 'email' => 'fitri@example.com', 'password' => Hash::make('password'), 'phone' => '086789012345', 'address' => 'Jl. Adam Malik No. 3', 'city' => 'Medan'],
            ['name' => 'Gunawan Santoso', 'email' => 'gunawan@example.com', 'password' => Hash::make('password'), 'phone' => '087890123456', 'address' => 'Jl. Pettarani No. 9', 'city' => 'Makassar'],
            ['name' => 'Hesti Permata', 'email' => 'hesti@example.com', 'password' => Hash::make('password'), 'phone' => '088901234567', 'address' => 'Jl. Demang No. 11', 'city' => 'Palembang'],
            ['name' => 'Irfan Hakim', 'email' => 'irfan@example.com', 'password' => Hash::make('password'), 'phone' => '089012345678', 'address' => 'Jl. Gatot Subroto No. 44', 'city' => 'Jakarta'],
            ['name' => 'Joko Widodo', 'email' => 'joko@example.com', 'password' => Hash::make('password'), 'phone' => '081123456789', 'address' => 'Jl. Solo No. 1', 'city' => 'Yogyakarta'],
            ['name' => 'Kartika Sari', 'email' => 'kartika@example.com', 'password' => Hash::make('password'), 'phone' => '082234567890', 'address' => 'Jl. Braga No. 18', 'city' => 'Bandung'],
            ['name' => 'Lukman Hakim', 'email' => 'lukman@example.com', 'password' => Hash::make('password'), 'phone' => '083345678901', 'address' => 'Jl. Basuki Rahmat No. 25', 'city' => 'Surabaya'],
        ];

        foreach ($customers as $c) {
            Customer::create(array_merge($c, ['email_verified_at' => now()]));
        }
    }
}
