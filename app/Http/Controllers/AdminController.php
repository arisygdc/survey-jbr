<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $data_user = User::select('nip', 'name', 'alamat', 'email')->get();
        return view('admin.users_index')->with('data_user', $data_user);
    }

    public function store_index() {
        return view('admin.register');
    }
}
