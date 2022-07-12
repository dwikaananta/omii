<?php

namespace App\Http\Controllers;

use App\Models\Sepatu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SepatuController extends Controller
{
    public function index()
    {
        $res = [
            'title' => 'Data Sepatu',
            'sepatu' => Sepatu::latest()->get(),
        ];

        return view('sepatu.sepatu', $res);
    }

    public function create()
    {
        $res = [
            'title' => 'Tambah Data Sepatu',
        ];

        return view('sepatu.create', $res);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'jumlah' => 'required',
            'bulan' => 'required|unique:sepatu,bulan',
        ]);

        Sepatu::create($data);

        return redirect('/sepatu')->with('success', 'Berhasil tambah data Sepatu !');
    }

    public function show(Sepatu $sepatu)
    {
        //
    }

    public function edit(Sepatu $sepatu)
    {
        $res = [
            'title' => 'Ubah Data Sepatu',
            'sepatu' => $sepatu,
        ];

        return view('sepatu.edit', $res);
    }

    public function update(Request $req, Sepatu $sepatu)
    {
        $data = $req->validate([
            'jumlah' => 'required',
            'bulan' => [
                'required',
                Rule::unique('sepatu')->ignore($sepatu, 'bulan'),
            ],
        ]);

        $sepatu->update($data);

        return redirect('/sepatu')->with('success', 'Berhasil ubah data Sepatu !');
    }

    public function destroy(Sepatu $sepatu)
    {
        Sepatu::destroy($sepatu->id);

        return redirect('/sepatu')->with('success', 'Berhasil hapus data Sepatu !');
    }
}