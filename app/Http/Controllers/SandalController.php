<?php

namespace App\Http\Controllers;

use App\Models\Sandal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SandalController extends Controller
{
    public function index()
    {
        $res = [
            'title' => 'Data Sandal',
            'sandal' => Sandal::latest()->get(),
        ];

        return view('sandal.sandal', $res);
    }

    public function create()
    {
        $res = [
            'title' => 'Tambah Data Sandal',
        ];

        return view('sandal.create', $res);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'jumlah' => 'required',
            'bulan' => 'required|unique:sandal,bulan',
        ]);

        Sandal::create($data);

        return redirect('/sandal')->with('success', 'Berhasil tambah data Sandal !');
    }

    public function show(Sandal $sandal)
    {
        //
    }

    public function edit(Sandal $sandal)
    {
        $res = [
            'title' => 'Ubah Data Sandal',
            'sandal' => $sandal,
        ];

        return view('sandal.edit', $res);
    }

    public function update(Request $req, Sandal $sandal)
    {
        $data = $req->validate([
            'jumlah' => 'required',
            'bulan' => [
                'required',
                Rule::unique('sandal')->ignore($sandal, 'bulan'),
            ],
        ]);

        $sandal->update($data);

        return redirect('/sandal')->with('success', 'Berhasil ubah data Sandal !');
    }

    public function destroy(Sandal $sandal)
    {
        Sandal::destroy($sandal->id);

        return redirect('/sandal')->with('success', 'Berhasil hapus data Sandal !');
    }
}
