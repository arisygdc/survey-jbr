<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kecamatan = [
            'Ambulu', 'Ajung', 'Arjasa', 'Balung', 'Bangsalsari', 'Gumuk Mas', 'Jelbuk', 'Jenggawah', 'Jombang', 'Kalisat', 'Kaliwates', 'Kencong', 'Ledokombo',
            'Mayang', 'Mumbulsari', 'Pakusari', 'Panti', 'Patrang', 'Puger', 'Rambipuji', 'Semboro', 'Silo', 'Sukorambi', 'Sukowono', 'Sumber Baru',
            'Sumberjambe', 'Sumbersari', 'Tanggul', 'Tempurejo', 'Umbulsari', 'Wuluhan'
        ];
        $user_id = [
            1,2
        ];
        $pecahan = [
            10000, 20000, 50000, 100000
        ];
        for ($i = 1; $i <= 300; $i++) {
            Survey::create([
                'user_id' => $user_id[rand(0,(sizeof($user_id)-1))],
                'kecamatan' => $kecamatan[rand(0,(sizeof($kecamatan)-1))],
                'pecahan' => $pecahan[rand(0, (sizeof($pecahan)-1))],
                'qlt' => rand(1,4),
                // 'foto'=> bcrypt('image385934gegse')
            ]);
        }
    }
}
