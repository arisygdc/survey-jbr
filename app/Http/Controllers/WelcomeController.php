<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        $queryUrl = ($request->input('pecahan') == 'upb') ? 'upb' : 'upk';
        $pecahan = [
            'upk' => [1, 3],
            'upb' => [4, 7]
        ];
        $table = $this->count_survey($pecahan[$queryUrl]);
        return view('welcome')->with('table', $table);
    }

    protected function count_survey($q) {
        return Survey::selectRaw('kecamatan, count(kecamatan_id) as disurvey, avg(qlt) as kualitas')
                        ->leftJoin('kecamatan', 'kecamatan_id', '=', 'kecamatan.id')
                        ->whereBetween('pecahan_id', $q)
                        ->groupBy('kecamatan_id')
                        ->get();
    }
}
