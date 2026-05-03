<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use App\Models\Payment;
use App\Models\ShipmentTracking;
use Carbon\Carbon;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $shipments = [
            [
                'tracking_number'        => 'KA20240001ABC',
                'sender_id'              => 1,
                'receiver_id'            => 3,
                'origin_branch_id'       => 1,
                'destination_branch_id'  => 3,
                'courier_id'             => 9,
                'rate_id'                => 3,
                'total_weight'           => 5.00,
                'total_price'            => 75000,
                'status'                 => 'delivered',
                'shipment_date'          => Carbon::now()->subDays(10)->toDateString(),
                'items' => [
                    ['item_name' => 'Baju Batik', 'quantity' => 3, 'weight' => 2.00],
                    ['item_name' => 'Celana Jeans', 'quantity' => 2, 'weight' => 3.00],
                ],
                'payment' => [
                    'amount' => 75000, 
                    'payment_method' => 'transfer', 
                    'payment_status' => 'paid', 
                    'payment_date' => Carbon::now()->subDays(10)->toDateString(), 
                    'midtrans_order_id' => 'KA20240001ABC-PAY',
                    'midtrans_bank' => 'bca'
                ],
                'trackings' => [
                    ['location' => 'Jakarta Pusat', 'description' => 'Paket dijemput dari pengirim', 'status' => 'picked_up', 'tracked_at' => Carbon::now()->subDays(10)],
                    ['location' => 'Gudang Jakarta', 'description' => 'Paket dalam perjalanan ke Surabaya', 'status' => 'in_transit', 'tracked_at' => Carbon::now()->subDays(9)],
                    ['location' => 'Cabang Surabaya', 'description' => 'Paket tiba di cabang Surabaya', 'status' => 'arrived_at_branch', 'tracked_at' => Carbon::now()->subDays(8)],
                    ['location' => 'Surabaya', 'description' => 'Paket sedang diantar ke penerima', 'status' => 'out_for_delivery', 'tracked_at' => Carbon::now()->subDays(7)],
                    ['location' => 'Rungkut, Surabaya', 'description' => 'Paket diterima oleh Budi Prakoso', 'status' => 'delivered', 'tracked_at' => Carbon::now()->subDays(7)],
                ],
            ],
            [
                'tracking_number'        => 'KA20240002DEF',
                'sender_id'              => 2,
                'receiver_id'            => 4,
                'origin_branch_id'       => 2,
                'destination_branch_id'  => 4,
                'courier_id'             => 11,
                'rate_id'                => 11,
                'total_weight'           => 3.50,
                'total_price'            => 38500,
                'status'                 => 'in_transit',
                'shipment_date'          => Carbon::now()->subDays(3)->toDateString(),
                'items' => [
                    ['item_name' => 'Buku Pelajaran', 'quantity' => 5, 'weight' => 2.50],
                    ['item_name' => 'Alat Tulis', 'quantity' => 1, 'weight' => 1.00],
                ],
                'payment' => [
                    'amount' => 38500, 
                    'payment_method' => 'e-wallet', 
                    'payment_status' => 'paid', 
                    'payment_date' => Carbon::now()->subDays(3)->toDateString(), 
                    'midtrans_order_id' => 'KA20240002DEF-PAY',
                    'midtrans_bank' => 'gopay'
                ],
                'trackings' => [
                    ['location' => 'Bandung', 'description' => 'Paket dijemput dari pengirim', 'status' => 'picked_up', 'tracked_at' => Carbon::now()->subDays(3)],
                    ['location' => 'Gudang Bandung', 'description' => 'Paket dalam perjalanan ke Yogyakarta', 'status' => 'in_transit', 'tracked_at' => Carbon::now()->subDays(2)],
                ],
            ],
            [
                'tracking_number'        => 'KA20240003GHI',
                'sender_id'              => 5,
                'receiver_id'            => 6,
                'origin_branch_id'       => 5,
                'destination_branch_id'  => 6,
                'courier_id'             => null,
                'rate_id'                => 28,
                'total_weight'           => 10.00,
                'total_price'            => 250000,
                'status'                 => 'pending',
                'shipment_date'          => Carbon::now()->toDateString(),
                'items' => [
                    ['item_name' => 'Elektronik', 'quantity' => 1, 'weight' => 7.00],
                    ['item_name' => 'Aksesori', 'quantity' => 3, 'weight' => 3.00],
                ],
                'payment' => [
                    'amount' => 250000, 
                    'payment_method' => 'transfer', 
                    'payment_status' => 'pending', 
                    'payment_date' => null, 
                    'midtrans_order_id' => 'KA20240003GHI-PAY',
                    'midtrans_bank' => 'mandiri',
                    'midtrans_biller_code' => '70012',
                    'midtrans_va_number' => '100749826869'
                ],
                'trackings' => [],
            ],
            [
                'tracking_number'        => 'KA20240004JKL',
                'sender_id'              => 7,
                'receiver_id'            => 8,
                'origin_branch_id'       => 7,
                'destination_branch_id'  => 8,
                'courier_id'             => null,
                'rate_id'                => 43,
                'total_weight'           => 2.00,
                'total_price'            => 56000,
                'status'                 => 'pending',
                'shipment_date'          => Carbon::now()->toDateString(),
                'items' => [
                    ['item_name' => 'Kosmetik', 'quantity' => 4, 'weight' => 2.00],
                ],
                'payment' => ['amount' => 56000, 'payment_method' => 'cash', 'payment_status' => 'paid', 'payment_date' => Carbon::now()->toDateString(), 'midtrans_order_id' => null],
                'trackings' => [],
            ],
            [
                'tracking_number'        => 'KA20240005MNO',
                'sender_id'              => 9,
                'receiver_id'            => 10,
                'origin_branch_id'       => 1,
                'destination_branch_id'  => 4,
                'courier_id'             => 10,
                'rate_id'                => 4,
                'total_weight'           => 8.00,
                'total_price'            => 96000,
                'status'                 => 'out_for_delivery',
                'shipment_date'          => Carbon::now()->subDays(2)->toDateString(),
                'items' => [
                    ['item_name' => 'Sepatu Olahraga', 'quantity' => 2, 'weight' => 4.00],
                    ['item_name' => 'Kaos Kaki', 'quantity' => 10, 'weight' => 2.00],
                    ['item_name' => 'Tas Gym', 'quantity' => 1, 'weight' => 2.00],
                ],
                'payment' => [
                    'amount' => 96000, 
                    'payment_method' => 'transfer', 
                    'payment_status' => 'paid', 
                    'payment_date' => Carbon::now()->subDays(2)->toDateString(), 
                    'midtrans_order_id' => 'KA20240005MNO-PAY',
                    'midtrans_bank' => 'mandiri',
                    'midtrans_biller_code' => '70012',
                    'midtrans_va_number' => '100749826868'
                ],
                'trackings' => [
                    ['location' => 'Jakarta Pusat', 'description' => 'Paket dijemput dari pengirim', 'status' => 'picked_up', 'tracked_at' => Carbon::now()->subDays(2)],
                    ['location' => 'Gudang Jakarta', 'description' => 'Paket dalam perjalanan ke Yogyakarta', 'status' => 'in_transit', 'tracked_at' => Carbon::now()->subDays(1)],
                    ['location' => 'Cabang Yogyakarta', 'description' => 'Paket tiba di cabang Yogyakarta', 'status' => 'arrived_at_branch', 'tracked_at' => Carbon::now()->subHours(5)],
                    ['location' => 'Yogyakarta', 'description' => 'Paket sedang diantar ke penerima', 'status' => 'out_for_delivery', 'tracked_at' => Carbon::now()->subHours(2)],
                ],
            ],
            [
                'tracking_number'        => 'KA20240006PQR',
                'sender_id'              => 11,
                'receiver_id'            => 12,
                'origin_branch_id'       => 2,
                'destination_branch_id'  => 3,
                'courier_id'             => 11,
                'rate_id'                => 12,
                'total_weight'           => 15.00,
                'total_price'            => 210000,
                'status'                 => 'arrived_at_branch',
                'shipment_date'          => Carbon::now()->subDays(1)->toDateString(),
                'items' => [
                    ['item_name' => 'Peralatan Dapur', 'quantity' => 3, 'weight' => 10.00],
                    ['item_name' => 'Bumbu Masak', 'quantity' => 5, 'weight' => 5.00],
                ],
                'payment' => [
                    'amount' => 210000, 
                    'payment_method' => 'e-wallet', 
                    'payment_status' => 'paid', 
                    'payment_date' => Carbon::now()->subDays(1)->toDateString(), 
                    'midtrans_order_id' => 'KA20240006PQR-PAY',
                    'midtrans_bank' => 'gopay'
                ],
                'trackings' => [
                    ['location' => 'Bandung', 'description' => 'Paket dijemput dari pengirim', 'status' => 'picked_up', 'tracked_at' => Carbon::now()->subDays(1)],
                    ['location' => 'Gudang Bandung', 'description' => 'Paket dalam perjalanan ke Surabaya', 'status' => 'in_transit', 'tracked_at' => Carbon::now()->subHours(12)],
                    ['location' => 'Cabang Surabaya', 'description' => 'Paket tiba di cabang Surabaya', 'status' => 'arrived_at_branch', 'tracked_at' => Carbon::now()->subHours(3)],
                ],
            ],
        ];

        foreach ($shipments as $data) {
            $shipment = Shipment::create([
                'tracking_number'       => $data['tracking_number'],
                'sender_id'             => $data['sender_id'],
                'receiver_id'           => $data['receiver_id'],
                'origin_branch_id'      => $data['origin_branch_id'],
                'destination_branch_id' => $data['destination_branch_id'],
                'current_branch_id'     => $data['origin_branch_id'],
                'payer_type'            => $data['payer_type'] ?? 'sender',
                'courier_id'            => $data['courier_id'],
                'rate_id'               => $data['rate_id'],
                'total_weight'          => $data['total_weight'],
                'total_price'           => $data['total_price'],
                'status'                => $data['status'],
                'shipment_date'         => $data['shipment_date'],
            ]);

            foreach ($data['items'] as $item) {
                ShipmentItem::create(array_merge(['shipment_id' => $shipment->id], $item));
            }

            if ($data['payment']) {
                Payment::create(array_merge(['shipment_id' => $shipment->id], $data['payment']));
            }

            foreach ($data['trackings'] as $tracking) {
                $branchId = null;
                if ($tracking['status'] === 'picked_up') $branchId = $shipment->origin_branch_id;
                if ($tracking['status'] === 'arrived_at_branch') $branchId = $shipment->destination_branch_id;

                ShipmentTracking::create(array_merge([
                    'shipment_id' => $shipment->id,
                    'branch_id'   => $branchId
                ], $tracking));

                if ($branchId) {
                    $shipment->update(['current_branch_id' => $branchId]);
                }
            }
        }
    }
}
