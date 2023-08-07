<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ["Selesai", "Menunggu Konfirmasi", "Dibatalkan"];

        foreach($status as $value){
            Status::create([
                'name' => $value
            ]);
        }
    }
}
