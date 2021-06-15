<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $pecahan = [
            10000, 20000, 50000, 100000
        ];
        $i = 100000;
        if(isset($q)) {
            foreach ($pecahan as $value) {
                if ($q == $value) {
                    $i = $q;
                }
            }
        }
        $survey = $this->get_survey($i);
        return view('welcome')->with('survey', $survey);
    }

    protected function get_survey($q) {
        return Survey::select(
            'kecamatan',
            'pecahan',
            'qlt'
        )->where('pecahan', $q)->get();
    }
}
