<?php

namespace Database\Seeders;

use App\Models\Pecahan;
use Illuminate\Database\Seeder;

class PecahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pecahan = [
            1000, 2000, 5000, 10000, 20000, 50000, 100000
        ];

        foreach($pecahan as $value) {
            Pecahan::create([
                'pecahan' => $value
            ]);
        }
    }
}
