<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(Request $req) {
    if ($req->user()) {
        return redirect('/barang')->with('success', 'Anda berhasil login !');
    } else {
        return view('login');
    }
});

Route::post('/login', function(Request $req) {
    $credentials = $req->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $req->session()->regenerate();
        return redirect()->intended('/barang')->with('success', 'Anda berhasil login !');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

Route::middleware(['is_user'])->group(function() {
    Route::resource('/barang', BarangController::class);

    Route::get('/peramalan', function() {
        $barang = Barang::orderBy('bulan', 'desc')->limit(10)->get();

        $sorted = array_values(Arr::sort($barang, function ($value) {
            return $value['bulan'];
        }));

        $res = [
            'title' => 'Data Peramalan',
            'barang' => $sorted,
        ];

        return view('peramalan', $res);
    });
});


Route::get('/logout', function(Request $req) {
    Auth::logout();

    $req->session()->invalidate();

    return redirect('/')->with('success', 'Anda berhasil logout !');
});
