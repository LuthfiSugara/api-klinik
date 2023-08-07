<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserLevel;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = ['Admin', 'Pasien', 'Dokter'];

        foreach($level as $value){
            UserLevel::create([
                'name' => $value
            ]);
        }
    }
}
