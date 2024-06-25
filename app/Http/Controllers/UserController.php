<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil daftar pengguna dari cache atau dari database jika tidak ada di cache
        $users = Cache::remember('users', 60, function () {
            return User::all();
        });

        return view('users.index', compact('users'));
    }
}
