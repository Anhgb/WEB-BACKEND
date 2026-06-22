<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $posts = Post::query()
            ->published() // Local Scope
            ->with(["user", "category", "tags"]) // Eager loading
            ->withCount("comments") // Đếm comments
            ->when($request->search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($q, $catId) {
                $q->ofCategory($catId); // Dùng scope với tham số
            })
            ->when($request->sort === 'popular', function ($q) {
                $q->popular(); // Scope popular
            }, function ($q) {
                $q->orderByDesc('published_at'); // Default: mới nhất
            })
            ->paginate(10)->withQueryString();

        $categories = \App\Models\Category::all();

        return view("posts.index", compact("posts", "categories"));
    }

    public function create()
    {
        return view('posts.create');
    }

    // Bước 3 — store(): tạo bài viết mới
    public function store(StorePostRequest $request)
    {
        Post::create($request->validated() + [
            'user_id' => Auth::id() ?? 1,
            'slug'    => Str::slug($request->title) . '-' . time(),
        ]);
        return redirect()->route('posts.index')
                         ->with('success', 'Đã thêm bài viết mới thành công.');
    }

    // Bước 2 — show(): chi tiết một bài viết (có Eager Loading)
    public function show($id)
    {
        $post = Post::with([
                        'user:id,name',
                        'category:id,name,slug',
                        'tags:id,name,slug',
                        'approvedComments.user:id,name',
                    ])
                    ->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Bước 4 — edit(): form sửa bài viết
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Bước 4 — update(): lưu bài viết đã sửa
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->validated());
        return redirect()->route('posts.index')
                         ->with('success', 'Đã cập nhật bài viết thành công.');
    }

    // Bước 5 — destroy(): xoá bài viết
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect()->route('posts.index')
                         ->with('success', 'Đã xoá bài viết.');
    }

    // Bước 5 Lab 3 — trashed(): danh sách bài viết đã xoá
    public function trashed()
    {
        $posts = Post::onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('posts.trashed', compact('posts'));
    }

    // Bước 5 Lab 3 — restore(): khôi phục bài viết
    public function restore($id)
    {
        Post::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('posts.trashed')
                         ->with('success', 'Đã khôi phục bài viết.');
    }
}
