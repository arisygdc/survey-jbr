<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validatedData = $request->validate([
            'user_id' => ['required', 'integer'],
            'kecamatan' => ['required', 'string', 'max:50'],
            'pecahan' => ['required', 'integer'],
            'qlt' => ['required', 'integer', 'max:1'],
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $nama_foto = bcrypt($request->file('foto')->getClientOriginalName());
        $request->file('foto')->store('public/images');
    
        $survey = new Survey();
        $survey->user_id = Auth::id();
        $survey->kecamatan = $request->kecamatan;
        $survey->pecahan = $request->pecahan;
        $survey->qlt = $request->qlt;
        $survey->foto = $nama_foto;

        if ($survey->save()) {
            return redirect()->route('survey')->with('status', 201);
        }
        return redirect()->route('survey')->with('status', 500);
    }

    public function survey_index() {
        $data = array(
            'Ambulu',
            'Ajung',
            'Arjasa',
            'Balung',
            'Bangsalsari',
            'Gumuk Mas',
            'Jelbuk',
            'Jenggawah',
            'Jombang',
            'Kalisat',
            'Kaliwates',
            'Kencong',
            'Ledokombo',
            'Mayang',
            'Mumbulsari',
            'Pakusari',
            'Panti',
            'Patrang',
            'Puger',
            'Rambipuji',
            'Semboro',
            'Silo',
            'Sukorambi',
            'Sukowono',
            'Sumber Baru',
            'Sumberjambe',
            'Sumbersari',
            'Tanggul',
            'Tempurejo',
            'Umbulsari',
            'Wuluhan'
        );
        return view('surveyer.survey')->with('data', $data);
    }

    public function get_survey() {
        // $data_survey = Survey::where('user_id', Auth::id());
        try {
            $data_survey = Survey::where('user_id', 2)->get();
        } catch(Exception $e) {

        }
    }
}
