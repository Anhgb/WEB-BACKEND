<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = [
            ['id' => 1, 'title' => 'Giới thiệu Laravel Framework', 'author' => 'Nguyễn Văn A', 'date' => '2024-01-15'],
            ['id' => 2, 'title' => 'Routing trong Laravel – Toàn tập', 'author' => 'Trần Thị B', 'date' => '2024-01-18'],
            ['id' => 3, 'title' => 'Blade Templates – Hướng dẫn chi tiết', 'author' => 'Lê Văn C', 'date' => '2024-01-22'],
            ['id' => 4, 'title' => 'Eloquent ORM – Làm việc với Database', 'author' => 'Phạm Thị D', 'date' => '2024-01-25'],
        ];

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Bài viết "' . $validated['title'] . '" đã được gửi thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $allArticles = [
            1 => [
                'id' => 1,
                'title' => 'Giới thiệu Laravel Framework',
                'author' => 'Nguyễn Văn A',
                'date' => '2024-01-15',
                'content' => 'Laravel là một PHP framework mã nguồn mở...'
            ],
            2 => [
                'id' => 2,
                'title' => 'Routing trong Laravel – Toàn tập',
                'author' => 'Trần Thị B',
                'date' => '2024-01-18',
                'content' => 'Routing là cơ chế ánh xạ URL đến xử lý logic...'
            ],
        ];

        if (! isset($allArticles[$id])) {
            abort(404, 'Bài viết không tồn tại');
        }

        $article = $allArticles[$id];

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}