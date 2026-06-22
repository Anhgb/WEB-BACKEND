@extends('layouts.app')

@section('title', $post->title)

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Bài viết</a></li>
        <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($post->title, 40) }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-8">
        {{-- Card nội dung chính --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body p-4">
                <h1 class="h2 mb-3">{{ $post->title }}</h1>

                {{-- Meta thông tin --}}
                <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                    <span class="text-muted">👤 {{ $post->user->name ?? 'N/A' }}</span>
                    <span class="text-muted">📂 {{ $post->category->name ?? 'Chưa phân loại' }}</span>
                    <span class="text-muted">📅 {{ $post->created_at->format('d/m/Y H:i') }}</span>
                </div>

                {{-- Tags --}}
                @if($post->tags->count() > 0)
                    <div class="mb-4">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}"
                               class="badge bg-info text-dark text-decoration-none me-1">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Nội dung bài viết --}}
                <div class="post-content" style="line-height: 1.8; font-size: 1.05rem;">
                    {{ $post->content }}
                </div>
            </div>
        </div>

        {{-- Nút điều hướng --}}
        <div class="d-flex justify-content-between mt-2 mb-4">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                ← Quay lại danh sách
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-primary">
                    ✏ Sửa bài
                </a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                      onsubmit="return confirmDelete('{{ addslashes($post->title) }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        🗑 Xóa
                    </button>
                </form>
            </div>
        </div>

        {{-- ===== PHẦN BÌNH LUẬN ===== --}}
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center gap-2">
                <strong>💬 Bình luận</strong>
                <span class="badge bg-secondary">{{ $post->approvedComments->count() }}</span>
            </div>
            <div class="card-body">
                @forelse($post->approvedComments as $comment)
                    <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                        {{-- Avatar tên viết tắt --}}
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center
                                    justify-content-center flex-shrink-0"
                             style="width:42px; height:42px; font-size:1rem;">
                            {{ strtoupper(substr($comment->user->name ?? '?', 0, 1)) }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong>{{ $comment->user->name ?? 'Ẩn danh' }}</strong>
                                <small class="text-muted">
                                    📅 {{ $comment->created_at->format('d/m/Y H:i') }}
                                    &nbsp;({{ $comment->created_at->diffForHumans() }})
                                </small>
                            </div>
                            <p class="mb-0">{{ $comment->body }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-3">
                        💬 Chưa có bình luận nào. Hãy là người đầu tiên!
                    </p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header"><strong>📋 Thông tin bài viết</strong></div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>ID:</strong> {{ $post->id }}
                </li>
                <li class="list-group-item">
                    <strong>Tác giả:</strong> {{ $post->user->name ?? 'N/A' }}
                </li>
                <li class="list-group-item">
                    <strong>Danh mục:</strong> {{ $post->category->name ?? 'Chưa có' }}
                </li>
                <li class="list-group-item">
                    <strong>Ngày đăng:</strong><br>
                    {{ $post->created_at->format('d/m/Y') }} ({{ $post->created_at->diffForHumans() }})
                </li>
                <li class="list-group-item">
                    <strong>Cập nhật:</strong><br>
                    {{ $post->updated_at->format('d/m/Y') }}
                </li>
            </ul>
        </div>

        {{-- Sidebar Tags --}}
        @if($post->tags->count() > 0)
        <div class="card">
            <div class="card-header"><strong>🏷 Tags</strong></div>
            <div class="card-body">
                @foreach($post->tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}"
                       class="badge bg-info text-dark text-decoration-none me-1 mb-1 fs-6">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(title) {
        return confirm('Bạn có chắc muốn xóa bài viết:\n"' + title + '" không?');
    }
</script>
@endpush

@endsection