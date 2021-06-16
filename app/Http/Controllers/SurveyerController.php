<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('surveyer.survey')->with('status', $status);
    }

    protected function validationSurvey($data) {
        return Validator::make($data, [
            'user_id' => ['required', 'integer'],
            'kecamatan' => ['required', 'integer', 'max:2'],
            'pecahan' => ['required', 'integer', 'max:10'],
            'qlt' => ['required', 'integer', 'max:1']
        ]);
    }

    protected function createSurvey($data) {
        try {
            Survey::create([
                'user_id' => $data['user_id'],
                'kecamatan' => $data['kecamatan'],
                'pecahan' => $data['pecahan'],
                'qlt' => $data['qlt'],
            ]);
        } catch(Exception $e) {
            return 500;
        }
        return 200;
    }

    public function survey_index() {
        
        return view('surveyer.survey');
    }
}
