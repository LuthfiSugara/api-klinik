<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'super admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123456'),
            'tanggal_lahir' => '1993/02/23',
            'id_gender' => '1',
            'no_hp' => '08213123123',
            'berat_badan' => '70',
            'tinggi_badan' => '170',
            'foto' => '/assets/images/profile/male.jpg',
        ]);
    }
}
