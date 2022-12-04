@extends('layouts.main')

@section('content')
    <div class="contaier">
        <div class="vh-100 d-flex justify-content-center align-items-center bg-primary">
            <form action="/login" method="POST" class="col-md-4 bg-white p-3">
                <h4 class="text-center">{{ env('APP_NAME') }} <br> Login Sistem </h4>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @include('layouts.alert')
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="username" name="email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="password" name="password" required>
                </div>
                <button class="btn btn-primary w-100" type="submit"><i class="fa fa-sign-in mr-1"></i>Login</button>
            </form>
        </div>
    </div>
@endsection
