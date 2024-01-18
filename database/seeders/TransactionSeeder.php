<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = User::where("role", "employee")->get();

        foreach ($employees as $employee) {
            // Generate 2-3 items for each warehouse
                $counter = 0;
                foreach (Item::orderBy(DB::raw('RAND()'))->take(6)->get() as $item) {
                    $status = "pending";

                    switch ($counter % 3) {
                        case 2:
                            $status = "delivered";
                            break;
                        case 1:
                            $status = "accepted";
                            break;
                        case 0:
                        default:
                    }
                    Transaction::create([
                        'status' => $status,
                        'item_id' => $item->id,
                        'user_id' => $employee->id,
                        'warehouse_id' => $item->warehouse->id,
                        'transaction_date' => now(),
                        'quantity' => rand(1, $item->quantity )
                    ]);
                    $counter = $counter + 1;

            }
        }
    }
}
