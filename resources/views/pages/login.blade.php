@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="w-25 mt-5 rounded p-4 shadow-lg">
            <h1 class="text-center mb-5">Login</h1>
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input name="nis" type="number" class="input form-control" id="nis"
                            placeholder="Masukkan NIS" />
                        @error('nis')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                {{-- <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS">
                    @error('nis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div> --}}
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input name="password" type="password" value="" class="input form-control" id="password"
                            placeholder="Masukkan Password" />
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hide();">
                                <i class="fas fa-eye" id="show_eye"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div> --}}
                <div class="col-12">
                    <button class="btn btn-primary w-100 mb-3 mt-3" type="submit" name="signin">Login</button>
                </div>
                {{-- <button type="submit" class="btn btn-primary w-100 mb-3 mt-3">Login</button> --}}
                <p class="text-center mb-0">Belum punya akun? <a href="{{ route('register.index') }}"
                        class="text-decoration-none">daftar</a></p>
            </form>
        </div>
    </div>
@endsection
