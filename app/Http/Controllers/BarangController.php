<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    public function index()
    {
        $res = [
            'title' => 'Data Barang',
            'barang' => Barang::latest()->get(),
        ];

        return view('barang.barang', $res);
    }

    public function create()
    {
        $res = [
            'title' => 'Tambah Data Barang',
        ];

        return view('barang.create', $res);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'jumlah' => 'required',
            'bulan' => 'required|unique:barang,bulan',
        ]);

        Barang::create($data);

        return redirect('/barang')->with('success', 'Berhasil tambah data Barang !');
    }

    public function show(Barang $barang)
    {
        //
    }

    public function edit(Barang $barang)
    {
        $res = [
            'title' => 'Ubah Data Barang',
            'barang' => $barang,
        ];

        return view('barang.edit', $res);
    }

    public function update(Request $req, Barang $barang)
    {
        $data = $req->validate([
            'jumlah' => 'required',
            'bulan' => [
                'required',
                Rule::unique('barang')->ignore($barang, 'bulan'),
            ],
        ]);

        $barang->update($data);

        return redirect('/barang')->with('success', 'Berhasil ubah data Barang !');
    }

    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);

        return redirect('/barang')->with('success', 'Berhasil hapus data Barang !');
    }
}
