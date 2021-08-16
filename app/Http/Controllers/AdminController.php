<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

    public function index() {
        return view('admin.index');
    }

    public function users_index() {
        $data_user = User::select('name', 'alamat', 'email')->get();
        return view('admin.users_index')->with('data_user', $data_user);
    }

    public function store_index() {
        return view('admin.register');
    }

    public function store(Request $request) {
        $data = [
            'name' => $request['name'],
            'alamat' => $request['alamat'],
            'tgl_lahir' => $request['tgl_lahir'],
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        $status = 500;
        if ($this->validateUser($data)) {
            $status = $this->createUser($data);
        }
        return view('admin.register')->with('status', $status);
    }

    protected function validateUser($data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function createUser($data) {
        try {
            $user = User::create([
                'name' => $data['name'],
                'alamat' => $data['alamat'],
                'tgl_lahir' => $data['tgl_lahir'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->assignRole('user');
        } catch(Exception $e) {
            return 500;
        }
        return 200;
    }
}
