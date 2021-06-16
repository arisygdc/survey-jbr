<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
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

        foreach($kecamatan as $value) {
            Kecamatan::create([
                'kecamatan' => $value
            ]);
        }
    }
}
