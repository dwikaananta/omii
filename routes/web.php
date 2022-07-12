<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HeelsController;
use App\Http\Controllers\SandalController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\UserController;
use App\Models\Barang;
use App\Models\Heels;
use App\Models\Sandal;
use App\Models\Sepatu;
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

    $user = User::count();

    if ($user == 0) {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin123'),
        ]);
    }

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
        return redirect()->intended('/dashboard')->with('success', 'Anda berhasil login !');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

Route::middleware(['is_user'])->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard', [
            'title' => 'Dashboard',
            'sepatu_total' => Sepatu::sum('jumlah'),
            'sepatu_min_date' => Sepatu::min('bulan'),
            'sepatu_max_date' => Sepatu::max('bulan'),
            'sandal_total' => Sandal::sum('jumlah'),
            'sandal_min_date' => Sandal::min('bulan'),
            'sandal_max_date' => Sandal::max('bulan'),
            'heels_total' => Heels::sum('jumlah'),
            'heels_min_date' => Heels::min('bulan'),
            'heels_max_date' => Heels::max('bulan'),
        ]);
    });

    Route::resource('/barang', BarangController::class);

    Route::resource('/sepatu', SepatuController::class);
    Route::resource('/sandal', SandalController::class);
    Route::resource('/heels', HeelsController::class);

    function getMax($max_bulan)
    {
        if ($max_bulan) {
            return $max = date('m-Y', strtotime("+1 months", strtotime($max_bulan)));
        } else {
            return null;
        }
    }

    Route::get('/sepatu-peramalan', function() {
        $sepatu = Sepatu::orderBy('bulan', 'desc')->limit(10)->get();

        $sorted = array_values(Arr::sort($sepatu, function ($value) {
            return $value['bulan'];
        }));

        $res = [
            'title' => 'Data Peramalan Sepatu',
            'sepatu' => $sorted,
            'max_date' => getMax(Sepatu::max('bulan')),
        ];

        return view('sepatu_peramalan', $res);
    });

    Route::get('/sandal-peramalan', function() {
        $sandal = Sandal::orderBy('bulan', 'desc')->limit(10)->get();

        $sorted = array_values(Arr::sort($sandal, function ($value) {
            return $value['bulan'];
        }));

        $res = [
            'title' => 'Data Peramalan Sandal',
            'sandal' => $sorted,
            'max_date' => getMax(Sandal::max('bulan')),
        ];

        return view('sandal_peramalan', $res);
    });

    Route::get('/heels-peramalan', function() {
        $heels = Heels::orderBy('bulan', 'desc')->limit(10)->get();

        $sorted = array_values(Arr::sort($heels, function ($value) {
            return $value['bulan'];
        }));

        $res = [
            'title' => 'Data Peramalan Heels',
            'heels' => $sorted,
            'max_date' => getMax(Heels::max('bulan')),
        ];

        return view('heels_peramalan', $res);
    });

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
