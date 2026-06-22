@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="container mt-5" style="max-width:500px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-3">Đăng nhập</h3>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" id="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary">Đăng nhập</button>
                    <a href="{{ route('home') }}" class="btn btn-link">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
