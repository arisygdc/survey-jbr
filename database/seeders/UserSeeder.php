<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::create([
            'nip' => '5624353',
            'name' => 'Admin',
            'alamat' => 'malang',
            'tgl_lahir' => '1997-12-12',
            'email' => 'admin@mail.com',
            'password' => bcrypt('bukaakun')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'nip' => '5624354',
            'name' => 'Surveyer Terang',
            'alamat' => 'Jember',
            'tgl_lahir' => '1997-12-12',
            'email' => 'surveyer.terang@mail.com',
            'password' => bcrypt('bukaakun')
        ]);
        
        $user->assignRole('user');

        $user = User::create([
            'nip' => '5624355',
            'name' => 'Surveyer Gelap',
            'alamat' => 'Jember',
            'tgl_lahir' => '1997-12-12',
            'email' => 'surveyer.gelap@mail.com',
            'password' => bcrypt('bukaakun')
        ]);

        $user->assignRole('user');
    }
}
