@extends('layouts.app')

@section('content')
<h2>Bài viết đã xoá</h2>

@forelse ($posts as $post)
<div class="d-flex justify-content-between align-items-center border-bottom py-2">
    <div>
        <strong>{{ $post->title }}</strong>
        <div class="text-muted small">Đã xoá lúc: {{ $post->deleted_at->format('d/m/Y H:i') }}</div>
    </div>
    <form action="{{ route('posts.restore', $post->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button class="btn btn-sm btn-outline-success">Khôi phục</button>
    </form>
</div>
@empty
<p>Không có bài viết nào trong thùng rác.</p>
@endforelse

{{ $posts->links() }}
@endsection
