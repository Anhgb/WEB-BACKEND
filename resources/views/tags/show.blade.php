@extends('layouts.app')

@section('title', 'Tag: #' . $tag->name)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">🏷 Tag: <span class="badge bg-info text-dark fs-5">#{{ $tag->name }}</span></h1>
        <p class="text-muted mb-0">{{ $posts->total() }} bài viết</p>
    </div>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">← Tất cả bài viết</a>
</div>

@forelse($posts as $post)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                    {{ $post->title }}
                </a>
            </h5>
            <small class="text-muted">
                👤 {{ $post->user->name ?? 'N/A' }}
                &nbsp;•&nbsp;
                📅 {{ $post->created_at->diffForHumans() }}
            </small>
            @if($post->tags->count() > 0)
                <div class="mt-2">
                    @foreach($post->tags as $t)
                        <a href="{{ route('tags.show', $t->slug) }}"
                           class="badge bg-info text-dark text-decoration-none me-1">#{{ $t->name }}</a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@empty
    <p class="text-muted text-center py-5">Chưa có bài viết nào với tag này.</p>
@endforelse

{{ $posts->links() }}

@endsection
