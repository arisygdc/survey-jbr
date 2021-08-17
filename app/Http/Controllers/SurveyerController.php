<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Pecahan;
use App\Models\Survey;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    protected function get_kecamatan() {
        return Kecamatan::select('id', 'kecamatan')->get();
    }

    protected function get_pecahan() {
        return Pecahan::select('id', 'pecahan')->get();
    }

    public function survey(Request $request) {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $imageName = Str::random(15) . time().'.'.request()->foto->getClientOriginalExtension();
        $status = 500;
        if ($this->validationSurvey($data)) {
            $data['foto'] = $imageName;
            $status = $this->createSurvey($data);
            request()->foto->move(public_path('images'), $imageName);
        }
        Session::flash('status', $status);
        return Redirect::back();
    }

    protected function validationSurvey($data) {
        return Validator::make($data, $rules = [
            'user_id' => 'Required|Numeric',
            'kecamatan' => 'Required|Numeric|max:2',
            'pecahan' => 'Required|Numeric|max:10',
            'qlt' => 'Required|Numeric|between:1,16',
            'foto' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1014'],
        ]);
    }

    protected function createSurvey($data) {
        try {
            Survey::create([
                'user_id' => $data['user_id'],
                'kecamatan_id' => $data['kecamatan'],
                'pecahan_id' => $data['pecahan'],
                'qlt' => $data['qlt'],
                'foto' => $data['foto']
            ]);
        } catch(Exception $e) {
            return 500;
        }
        return 200;
    }
}
