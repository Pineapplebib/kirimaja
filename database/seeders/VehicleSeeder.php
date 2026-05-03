<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            ['plate_number' => 'B 1234 KA', 'type' => 'motor', 'branch_id' => 1, 'ownership' => 'personal'],
            ['plate_number' => 'B 5678 KA', 'type' => 'motor', 'branch_id' => 1, 'ownership' => 'personal'],
            ['plate_number' => 'D 2345 KA', 'type' => 'mobil', 'branch_id' => 2, 'ownership' => 'company'],
            ['plate_number' => 'L 3456 KA', 'type' => 'motor', 'branch_id' => 3, 'ownership' => 'personal'],
            ['plate_number' => 'AB 4567 KA', 'type' => 'truck', 'branch_id' => 4, 'ownership' => 'company'],
        ];

        foreach ($vehicles as $index => $vehicleData) {
            $vehicle = Vehicle::create($vehicleData);
            
            // Pasangkan ke kurir berdasarkan data sebelumnya (ID 9-13)
            $courierId = 9 + $index;
            User::where('id', $courierId)->update(['vehicle_id' => $vehicle->id]);
        }
    }
}
