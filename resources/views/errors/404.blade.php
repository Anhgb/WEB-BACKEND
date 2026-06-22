@extends('layouts.app')

@section('title', '404 – Không tìm thấy trang')

@section('content')
<div class="text-center py-5">
    <div style="font-size: 6rem; line-height: 1;">🔍</div>
    <h1 class="display-1 fw-bold text-danger">404</h1>
    <h2 class="mb-3">Trang không tìm thấy</h2>
    <p class="text-muted mb-4">
        Trang bạn đang tìm kiếm không tồn tại, đã bị xóa hoặc URL bị sai.
    </p>
    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('home') }}" class="btn btn-primary">
            🏠 Về trang chủ
        </a>
        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
            📰 Xem bài viết
        </a>
    </div>
</div>
@endsection
