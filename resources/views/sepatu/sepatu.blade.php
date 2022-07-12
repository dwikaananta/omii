@extends('layouts.main')

@section('content')

    <div class="text-right mb-3">
        <a href="/sepatu/create" class="btn btn-primary px-3">Tambah Data</a>
    </div>

    @include('layouts.alert')
    <table class="table table-sm" id="table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Bulan</th>
                <th class="text-center"><i class="fa fa-bars"></i></th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($sepatu as $i)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $i->jumlah }}</td>
                    <td class="text-center">{{ date('m-Y', strtotime($i->bulan)) }}</td>
                    <td class="text-center">
                        <form class="btn-group" method="POST" action="/sepatu/{{ $i->id }}">
                            @csrf
                            @method('DELETE')
                            <a href="/sepatu/{{ $i->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="if (confirm('Yakin hapus data ?')) {return true} return false"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
