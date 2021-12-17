@extends('layouts.main')

@section('content')

    <form action="/barang/{{ $barang->id }}" method="POST" class="row">
        @csrf
        @method('PATCH')
        <div class="form-group col-md-6">
            <label for="">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" value="{{ old('jumlah') ?? $barang->jumlah }}">
            @error('jumlah')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="">Bulan</label>
            <input type="month" class="form-control" name="bulan" value="{{ old('bulan') ?? $barang->bulan }}">
            @error('bulan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="btn-group col-6">
            <button type="submit" class="btn btn-primary">Ubah</button>
            <a href="/barang" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

@endsection
