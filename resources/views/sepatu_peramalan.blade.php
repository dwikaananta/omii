@extends('layouts.main')

@section('content')

    <div class="btn-group mb-3">
        <button class="btn btn-sm btn-primary" onclick="show()">Show</button>
        <button class="btn btn-sm btn-secondary" onclick="hide()">Hide</button>
    </div>

    @if (count($sepatu) > 1)
        <div id="data" style="display: none">
            <table class="table table-sm mb-5">
                <thead>
                    <tr>
                        <th>No (X)</th>
                        <th>Jumlah (Y)</th>
                        <th>Bulan</th>
                        <th>XY</th>
                        <th>^X2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sepatu as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->jumlah }}</td>
                            <td>{{ date('m-Y', strtotime($i->bulan)) }}</td>
                            <td>{{ $loop->iteration * $i->jumlah }}</td>
                            <td>{{ $loop->iteration * $loop->iteration }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @foreach ($sepatu as $i)
                        @if ($loop->first)
                            @php
                                $zx = $loop->iteration;
                                $zy = $i->jumlah;
                                $zxy = $loop->iteration * $i->jumlah;
                                $zx2 = $loop->iteration * $loop->iteration;
                            @endphp
                        @endif

                        @if (!$loop->first && !$loop->last)
                            @php
                                $zx += $loop->iteration;
                                $zy += $i->jumlah;
                                $zxy += $loop->iteration * $i->jumlah;
                                $zx2 += $loop->iteration * $loop->iteration;
                            @endphp
                        @endif

                        @if ($loop->last)
                            <tr>
                                <th>{{ $zx += $loop->iteration }}</th>
                                <th>{{ $zy += $i->jumlah }}</th>
                                <th>-</th>
                                <th>{{ $zxy += $loop->iteration * $i->jumlah }}</th>
                                <th>{{ $zx2 += $loop->iteration * $loop->iteration }}</th>
                            </tr>
                            @php
                                $lastx = $loop->iteration;
                            @endphp
                        @endif
                    @endforeach
                </tfoot>
            </table>

            @php
                $b = ($lastx * $zxy - $zx * $zy) / ($lastx * ($zx * $zx) - $zx * $zx);
                $a = ($zy - $zx * $b) / $lastx;
            @endphp

            <table class="table table-sm mb-5">
                <thead>
                    <tr>
                        <th>No (X)</th>
                        <th>Jumlah (Y)</th>
                        <th>(Yi)</th>
                        <th>Bulan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sepatu as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->jumlah }}</td>
                            <td>{{ $a + $b * $loop->iteration }}</td>
                            <td>{{ date('m-Y', strtotime($i->bulan)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @foreach ($sepatu as $i)
                        @if ($loop->first)
                            @php
                                $zx = $loop->iteration;
                                $zy = $i->jumlah;
                                $zyi = $a + $b * $loop->iteration;
                            @endphp
                        @endif

                        @if (!$loop->first && !$loop->last)
                            @php
                                $zx += $loop->iteration;
                                $zy += $i->jumlah;
                                $zyi += $a + $b * $loop->iteration;
                            @endphp
                        @endif

                        @if ($loop->last)
                            <tr>
                                <th>{{ $zx += $loop->iteration }}</th>
                                <th>{{ $zy += $i->jumlah }}</th>
                                <th>{{ $zyi += $a + $b * $loop->iteration }}</th>
                                <th>-</th>
                            </tr>
                            @php
                                $lastx = $loop->iteration;
                            @endphp
                        @endif
                    @endforeach
                </tfoot>
            </table>

            <table class="table table-sm mb-5">
                <thead>
                    <tr>
                        <th>Y - Yi</th>
                        <th>(Y - Yi)^2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sepatu as $i)
                        <tr>
                            <td>{{ $i->jumlah - ($a + $b * $loop->iteration) }}</td>
                            <td>{{ ($i->jumlah - ($a + $b * $loop->iteration)) * ($i->jumlah - ($a + $b * $loop->iteration)) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @foreach ($sepatu as $i)
                        @if ($loop->first)
                            @php
                                $yyi2 = ($i->jumlah - ($a + $b * $loop->iteration)) * ($i->jumlah - ($a + $b * $loop->iteration));
                            @endphp
                        @endif

                        @if (!$loop->first && !$loop->last)
                            @php
                                $yyi2 += ($i->jumlah - ($a + $b * $loop->iteration)) * ($i->jumlah - ($a + $b * $loop->iteration));
                            @endphp
                        @endif

                        @if ($loop->last)
                            <tr>
                                <th>-</th>
                                <th>{{ $yyi2 += ($i->jumlah - ($a + $b * $loop->iteration)) * ($i->jumlah - ($a + $b * $loop->iteration)) }}
                                </th>
                            </tr>
                            @php
                                $lastx = $loop->iteration;
                            @endphp
                        @endif
                    @endforeach
                </tfoot>
            </table>
        </div>


        <h1>Hasil peramalan pada {{ $max_date }} = {{ round($a + $b * ($lastx + 1), 2) }}</h1>
        <h1>MSE = {{ round($yyi2 / $lastx, 2) }}</h1>
    @else
        <h3>Data sepatu kurang dari 2 bulan, setidaknya harus ada dua data agar dapat melakukan peramalan !</h3>
    @endif

@endsection


@section('jquery')
    <script>
        let data = $('#data');

        const show = () => {
            data.show();
        }
        const hide = () => {
            data.hide();
        }
    </script>
@endsection