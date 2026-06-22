@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
{{-- Header section: tiêu đề + thống kê --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">📰 Danh sách bài viết</h1>
        {{-- Hiển thị tổng số bài: $totalPosts được truyền từ Controller --}}
        <p class="text-muted mb-0">Tổng cộng {{ $posts->total() }} bài viết</p>
    </div>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        ✏ Viết bài mới
    </a>
</div>

{{-- Bước 4 Lab 2: Form tìm kiếm và lọc --}}
<form method="GET" action="{{ route('posts.index') }}" class="mb-4 bg-light p-3 rounded border">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tìm kiếm...">
        </div>
        <div class="col-md-3">
            <select name="category_id" class="form-select">
                <option value="">Tất cả danh mục</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Mới nhất</option>
                <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Phổ biến nhất</option>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-grow-1">Tìm</button>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Xóa</a>
        </div>
    </div>
</form>

{{-- 
    @forelse: kết hợp @foreach + xử lý trường hợp rỗng
    Nếu $posts rỗng -> vào @empty, bỏ qua vòng lặp
--}}
@forelse ($posts as $post)

    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">

                    {{-- Số thứ tự dùng $loop->iteration (bắt đầu từ 1, không phải 0) --}}
                    <span class="text-muted small">#{{ $loop->iteration }}</span>

                    {{-- Tiêu đề bài viết - link đến trang chi tiết --}}
                    <h5 class="card-title mt-1">
                        <a href="{{ route('posts.show', $post->id) }}"
                           class="text-decoration-none text-dark">
                            {{ $post->title }}
                        </a>
                    </h5>

                    {{-- Tóm tắt nội dung --}}
                    <p class="card-text text-muted">
                        {{ $post->excerpt }}
                    </p>

                    {{-- Thông tin tác giả, danh mục, bình luận, ngày đăng, thời gian đọc --}}
                    <small class="text-muted">
                        👤 {{ $post->user->name ?? 'N/A' }}
                        &nbsp;•&nbsp;
                        📅 {{ $post->published_at?->format('d/m/Y') ?? 'Chưa xuất bản' }}
                        &nbsp;•&nbsp;
                        ⏱ {{ $post->reading_time }}
                        &nbsp;•&nbsp;
                        💬 {{ $post->comments_count }} bình luận
                        &nbsp;•&nbsp;
                        📂 {{ $post->category->name ?? 'Chưa có danh mục' }}
                    </small>
                    
                    {{-- Hiển thị Tags --}}
                    @if($post->tags->count() > 0)
                        <div class="mt-2">
                            @foreach($post->tags as $tag)
                                <span class="badge bg-info text-dark">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Badge trạng thái: màu khác nhau tùy status --}}
                <div class="ms-3">
                    {{-- Nếu có trường trạng thái, hiển thị badge; ngược lại bỏ qua --}}
                    @if (isset($post->status))
                        @if ($post->status === 'published')
                            <span class="badge bg-success">✅ Đã xuất bản</span>
                        @elseif ($post->status === 'draft')
                            <span class="badge bg-warning text-dark">📝 Bản nháp</span>
                        @else
                            <span class="badge bg-secondary">? Không xác định</span>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Nút hành động: chỉ hiển thị Separator nếu không phải item cuối --}}
            <div class="mt-2 pt-2 border-top d-flex gap-2">
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">Xem</a>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary">Sửa</a>

                {{-- Form xóa: cần @csrf + @method('DELETE') + confirmDelete JS --}}
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                      onsubmit="return confirmDelete('{{ addslashes($post->title) }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        🗑 Xóa
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Dùng $loop->last để thêm xử lý đặc biệt cho phần tử cuối --}}
    @if ($loop->last)
        <p class="text-center text-muted small mt-3">
            — Đã hiển thị tất cả {{ $loop->count }} bài viết —
        </p>
    @endif

@empty
    {{-- Hiển thị khi $posts rỗng (không có bài viết nào) --}}
    <div class="text-center py-5">
        <p class="text-muted fs-4">📭 Chưa có bài viết nào.</p>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mt-2">
            ✏ Viết bài đầu tiên
        </a>
    </div>
@endforelse

{{-- Bước 6 Lab 2: hiển thị nút phân trang --}}
{{ $posts->links() }}

@push('scripts')
<script>
    function confirmDelete(title) {
        return confirm('Bạn có chắc muốn xóa bài viết:\n"' + title + '" không?');
    }
</script>
@endpush
@endsection
