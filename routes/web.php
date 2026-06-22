<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PostController;


// Bước 4 Lab 3 — Route cho bài viết đã xoá
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

// Route::resource tự tạo đầy đủ 7 routes chuẩn RESTful với Route Model Binding
Route::resource('posts', PostController::class);

// Route trang tag — hiển thị các bài viết theo tag
Route::get('/tags/{tag:slug}', function (\App\Models\Tag $tag) {
    $posts = $tag->posts()->with(['user:id,name', 'tags:id,name,slug'])->paginate(10);
    return view('tags.show', compact('tag', 'posts'));
})->name('tags.show');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/ve-chung-toi', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ✅ GET /login — hiển thị form đăng nhập
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// ✅ POST /login — xử lý đăng nhập
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('posts.index'));
    }

    return back()->withErrors([
        'email' => 'Email hoặc mật khẩu không đúng.',
    ])->onlyInput('email');
})->name('login.post');

// ✅ POST /logout — đăng xuất
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

Route::prefix('shop')->group(function () {

    Route::get('/products', function () {
        return view('shop.products');
    })->name('shop.products');

    Route::get('/cart', function () {
        return view('shop.cart');
    })->name('shop.cart');
});

Route::resource('articles', ArticleController::class);


