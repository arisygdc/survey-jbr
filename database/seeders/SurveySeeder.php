<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Pecahan;
use App\Models\Survey;
use App\Models\User;
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
        $pecahan = Pecahan::select('id')->count();
        $kecamatan = Kecamatan::select('id')->count();
        $user_id = User::select('id')->count();
        
        for ($i = 1; $i <= 300; $i++) {
            Survey::create([
                'user_id' => rand(2,$user_id),
                'kecamatan_id' => rand(1, $kecamatan),
                'pecahan_id' => rand(1, $pecahan),
                'qlt' => rand(1,16),
            ]);
        }
    }
}
