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
        Survey::create([
            'user_id' => 2,
            'kecamatan' => 'ajung',
            'pecahan' => 100000,
            'qlt' => 3,
            // 'foto'=> bcrypt('image385934gegse')
        ]);
    }
}
