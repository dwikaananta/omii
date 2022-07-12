@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-4 text-center border">
            <h4 class="m-0">Total Jumlah Sepatu</h4>
            <h6 class="text-secondary mb-3">{{ $sepatu_min_date ? date('m-Y', strtotime($sepatu_min_date)) : '' }} s/d
                {{ $sepatu_max_date ? date('m-Y', strtotime($sepatu_max_date)) : '' }}</h6>
            <h3 class="text-success">{{ $sepatu_total }}</h3>
        </div>
        <div class="col-4 text-center border">
            <h4 class="m-0">Total Jumlah Sandal</h4>
            <h6 class="text-secondary mb-3">{{ $sandal_min_date ? date('m-Y', strtotime($sandal_min_date)) : '' }} s/d
                {{ $sandal_max_date ? date('m-Y', strtotime($sandal_max_date)) : '' }}</h6>
            <h3 class="text-success">{{ $sandal_total }}</h3>
        </div>
        <div class="col-4 text-center border">
            <h4 class="m-0">Total Jumlah Heels</h4>
            <h6 class="text-secondary mb-3">{{ $heels_min_date ? date('m-Y', strtotime($heels_min_date)) : '' }} s/d
                {{ $heels_max_date ? date('m-Y', strtotime($heels_max_date)) : '' }}</h6>
            <h3 class="text-success">{{ $heels_total }}</h3>
        </div>
    </div>
@endsection
