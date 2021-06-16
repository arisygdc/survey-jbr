<?php

namespace App\Http\Controllers;

use App\Models\Survey;

class WelcomeController extends Controller
{
    public function index() {
        $pecahan = [
            1, 2, 3, 4
        ];
        $i = 4;
        if(isset($q)) {
            foreach ($pecahan as $value) {
                if ($q == $value) {
                    $i = $q;
                }
            }
        }
        $table = $this->count_survey($i);
        return view('welcome')->with('table', $table);
    }

    protected function count_survey($q) {
        return Survey::selectRaw('kecamatan, count(kecamatan_id) as disurvey, avg(qlt) as kualitas')
                        ->leftJoin('kecamatan', 'kecamatan_id', '=', 'kecamatan.id')
                        ->where('pecahan_id', $q)
                        ->groupBy('kecamatan_id')
                        ->get();
    }
}
