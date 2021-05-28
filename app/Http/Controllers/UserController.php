<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function __construct()
    {
        
    }

    public function index() {
        echo "User Dashboard";
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

    public function get_survey() {
        // $data_survey = Survey::where('user_id', Auth::id());
        $data_survey = Survey::where('user_id', 2)->get();
        dd($data_survey);
    }
}
