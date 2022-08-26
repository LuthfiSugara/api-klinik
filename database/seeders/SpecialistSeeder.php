<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Specialist;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialist = ['Umum', 'Bedah', 'THT'];

        foreach($specialist as $value){
            Specialist::create([
                'name' => $value
            ]);
        }
    }
}
