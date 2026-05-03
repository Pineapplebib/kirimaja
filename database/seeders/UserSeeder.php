<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin
            ['name' => 'Super Admin', 'email' => 'admin@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'admin', 'branch_id' => 1],

            // Managers
            ['name' => 'Budi Santoso', 'email' => 'manager.jkt@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'manager', 'branch_id' => 1],
            ['name' => 'Sari Dewi', 'email' => 'manager.bdg@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'manager', 'branch_id' => 2],
            ['name' => 'Hendra Wijaya', 'email' => 'manager.sby@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'manager', 'branch_id' => 3],

            // Cashiers
            ['name' => 'Rina Kasir Jakarta', 'email' => 'kasir1.jkt@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'cashier', 'branch_id' => 1],
            ['name' => 'Tono Kasir Jakarta', 'email' => 'kasir2.jkt@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'cashier', 'branch_id' => 1],
            ['name' => 'Wati Kasir Bandung', 'email' => 'kasir1.bdg@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'cashier', 'branch_id' => 2],
            ['name' => 'Agus Kasir Surabaya', 'email' => 'kasir1.sby@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'cashier', 'branch_id' => 3],

            // Couriers
            ['name' => 'Zaki Kurir Jakarta 1', 'email' => 'kurir1.jkt@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'courier', 'branch_id' => 1],
            ['name' => 'Fajar Kurir Jakarta 2', 'email' => 'kurir2.jkt@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'courier', 'branch_id' => 1],
            ['name' => 'Gilang Kurir Bandung', 'email' => 'kurir1.bdg@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'courier', 'branch_id' => 2],
            ['name' => 'Hadi Kurir Surabaya', 'email' => 'kurir1.sby@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'courier', 'branch_id' => 3],
            ['name' => 'Irwan Kurir Yogyakarta', 'email' => 'kurir1.yog@kirimaja.id', 'password' => Hash::make('password'), 'role' => 'courier', 'branch_id' => 4],
        ];

        foreach ($users as $user) {
            User::create(array_merge($user, ['email_verified_at' => now()]));
        }
    }
}
