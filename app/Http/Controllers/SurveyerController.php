<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Pecahan;
use App\Models\Survey;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SurveyerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['role:user']);
    }

    public function index() {
        return view("surveyer.index");
    }

    public function survey_index() {
        $kecamatan = $this->get_kecamatan();
        $pecahan = $this->get_pecahan();
        return view('surveyer.survey')->with(['kecamatan' => $kecamatan, 'pecahan' => $pecahan]);
    }

    public function survey(Request $request) {
        $data = [
            'user_id' => Auth::user()->id,
            'kecamatan' => $request['kecamatan'],
            'pecahan' => $request['pecahan'],
            'qlt' => $request['qlt'],
        ];
        $status = 500;
        if ($this->validationSurvey($data)) {
            $status = $this->createSurvey($data);
        }
        return Redirect::back()->with(['status' => $status]);
    }

    protected function get_kecamatan() {
        return Kecamatan::select('id', 'kecamatan')->get();
    }

    protected function get_pecahan() {
        return Pecahan::select('id', 'pecahan')->get();
    }

    protected function validationSurvey($data) {
        return Validator::make($data, [
            'user_id' => ['required', 'integer'],
            'kecamatan_id' => ['required', 'integer', 'max:2'],
            'pecahan_id' => ['required', 'integer', 'max:10'],
            'qlt' => ['required', 'integer', 'max:1']
        ]);
    }

    protected function createSurvey($data) {
        try {
            Survey::create([
                'user_id' => $data['user_id'],
                'kecamatan_id' => $data['kecamatan'],
                'pecahan_id' => $data['pecahan'],
                'qlt' => $data['qlt'],
            ]);
        } catch(Exception $e) {
            return 500;
        }
        return 200;
    }
}
