@extends('layouts.app')
 
@section('content')
    <div class="d-flex justify-content-center">
        <div class="w-25 mt-5 rounded p-4 shadow-lg">
            <h1 class="text-center mb-5">Register</h1>
            <form action="">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Nama</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan Nama">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">NIS</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan NIS">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan Email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan Password">
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3 mt-3">Login</button>
                <p class="text-center mb-0">Sudah punya akun? <a href="/login" class="text-decoration-none">Masuk</a></p>
                
            </form>
        </div>
    </div>
@endsection
 