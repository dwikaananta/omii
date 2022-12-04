<?php

namespace App\Http\Controllers;

use App\Models\Heels;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HeelsController extends Controller
{
    public function index()
    {
        $res = [
            'title' => 'Data Heels',
            'heels' => Heels::latest()->get(),
        ];

        return view('heels.heels', $res);
    }

    public function create()
    {
        $res = [
            'title' => 'Tambah Data Heels',
        ];

        return view('heels.create', $res);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'jumlah' => 'required',
            'bulan' => 'required|unique:heels,bulan',
        ]);

        Heels::create($data);

        return redirect('/heels')->with('success', 'Berhasil tambah data Heels !');
    }

    public function show(Heels $heels)
    {
        //
    }

    public function edit($id)
    {
        $heels = Heels::find($id);

        $res = [
            'title' => 'Ubah Data Heels',
            'heels' => $heels,
        ];

        return view('heels.edit', $res);
    }

    public function update(Request $req, $id)
    {
        $heels = Heels::find($id);
        $data = $req->validate([
            'jumlah' => 'required',
            'bulan' => [
                'required',
                Rule::unique('heels')->ignore($heels, 'bulan'),
            ],
        ]);

        $heels->update($data);

        return redirect('/heels')->with('success', 'Berhasil ubah data Heels !');
    }

    public function destroy($id)
    {
        Heels::destroy($id);

        return redirect('/heels')->with('success', 'Berhasil hapus data Heels !');
    }
}
