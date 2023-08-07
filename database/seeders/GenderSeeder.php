<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = ["Laki-laki", "Perempuan"];

        foreach($genders as $value){
            Gender::create([
                'name' => $value
            ]);
        }
    }
}
