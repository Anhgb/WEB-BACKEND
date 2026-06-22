@extends('layouts.app')

@section('title', '403 – Không có quyền truy cập')

@section('content')
<div class="text-center py-5">
    <div style="font-size: 6rem; line-height: 1;">🚫</div>
    <h1 class="display-1 fw-bold text-warning">403</h1>
    <h2 class="mb-3">Không có quyền truy cập</h2>
    <p class="text-muted mb-4">
        Bạn không có quyền truy cập trang này. Vui lòng đăng nhập hoặc liên hệ quản trị viên.
    </p>
    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('home') }}" class="btn btn-primary">
            🏠 Về trang chủ
        </a>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary">
            🔑 Đăng nhập
        </a>
    </div>
</div>
@endsection
