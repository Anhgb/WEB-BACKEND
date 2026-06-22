@extends('layouts.app')

@section('title', 'Tạo bài viết mới')

@section('content')
    <h1>✍ Tạo bài viết mới</h1>

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <label>Tiêu đề:</label>
        <input type="text" name="title" placeholder="Nhập tiêu đề bài viết">

        <label>Tác giả:</label>
        <input type="text" name="author" placeholder="Tên tác giả">

        <label>Nội dung</label>
        <textarea name="content" rows="8" placeholder="Viết nội dung..."></textarea>

        <button type="submit">Đăng bài</button>
    </form>

    <br>
    <a href="{{ route('articles.index') }}">← Quay lại</a>
@endsection
