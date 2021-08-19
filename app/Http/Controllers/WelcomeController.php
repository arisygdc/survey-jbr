<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        $queryUrl = ($request->input('pecahan') !== null) ? $request->input('pecahan') : '1000';
        $pecahan = [
            '1000' => 1,
            '2000' => 2,
            '5000' => 3,
            '10000' => 4
        ];
        $table = $this->count_survey($pecahan[$queryUrl]);
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
