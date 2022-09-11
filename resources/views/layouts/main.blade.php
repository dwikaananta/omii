<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

    {{-- <style>
        .bg-primary {
            background-color: #acacac !important;
        }

        .bg-success {
            background-color: #acacac !important;
        }

        .bg-danger {
            background-color: #acacac !important;
        }

        .btn-success {
            background-color: #acacac !important;
            border-color: #acacac;
        }

        .btn-danger {
            background-color: #acacac !important;
            border-color: #acacac;
        }

        .btn-primary {
            background-color: #acacac !important;
            border-color: #acacac;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #acacac;
            border-color: #acacac;
        }

        .btn-primary {
            color: #fff;
            background-color: #acacac;
            border-color: #acacac;
        }

        .text-success {
            color: black !important;
        }
    </style> --}}

    <title>{{ env('APP_NAME') }}</title>
</head>

<body class="bg-light">

    @if (auth()->check())
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/dashboard"><i class="fa fa-dashboard mr-1"></i> Dashboard</a>
                        </li>
                        <li class="nav-item active dropdown">
                            <a class="nav-link" href="#" id="ddSepatu" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa fa-caret-square-down mr-1"></i> Sepatu
                            </a>
                            <div class="dropdown-menu" aria-labelledby="ddSepatu">
                                <a class="dropdown-item" href="/sepatu">Data Sepatu</a>
                                <a class="dropdown-item" href="/sepatu-peramalan">Peramalan Sepatu</a>
                            </div>
                        </li>
                        <li class="nav-item active dropdown">
                            <a class="nav-link" href="#" id="ddSandal" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa fa-caret-square-down mr-1"></i> Sandal
                            </a>
                            <div class="dropdown-menu" aria-labelledby="ddSandal">
                                <a class="dropdown-item" href="/sandal">Data Sandal</a>
                                <a class="dropdown-item" href="/sandal-peramalan">Peramalan Sandal</a>
                            </div>
                        </li>
                        <li class="nav-item active dropdown">
                            <a class="nav-link" href="#" id="ddHeels" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa fa-caret-square-down mr-1"></i> Heels
                            </a>
                            <div class="dropdown-menu" aria-labelledby="ddHeels">
                                <a class="dropdown-item" href="/heels">Data Heels</a>
                                <a class="dropdown-item" href="/heels-peramalan">Peramalan Heels</a>
                            </div>
                        </li>
                        {{-- <li class="nav-item active">
                            <a class="nav-link" href="/barang"><i class="fa fa-box-open mr-1"></i> Barang</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/peramalan"><i class="fa fa-search mr-1"></i> Peramalan</a>
                        </li> --}}
                        <li class="nav-item active">
                            <a href="/logout" class="nav-link" href="/peramalan"
                                onclick="if (confirm('Yakin logout ?')) {return true} return false"><i
                                    class="fa fa-sign-out mr-1"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container bg-white pb-5">
            <div class="card-header mb-3">
                {{ $title ?? null }}
            </div>
            @yield('content')
        </div>

        <div class="py-3 bg-white text-center container border-top">
            Copyright © MiMayun Shop <script>
                document.write(new Date().getFullYear())
            </script>
        </div>
    @else
        @yield('content')
    @endif

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

    @yield('jquery')
</body>

</html>
