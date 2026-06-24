<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$req = Illuminate\Http\Request::create('/posts', 'GET', ['search' => 'a', 'category_id' => 1]);

$posts = App\Models\Post::query()
    ->published()
    ->when($req->search, function ($q, $search) {
        $q->where('title', 'like', "%{$search}%");
    })
    ->when($req->category_id, function ($q, $catId) {
        $q->ofCategory($catId);
    })
    ->get();

echo "Count for search='a' and category=1: " . $posts->count() . "\n";

$all = App\Models\Post::published()->count();
echo "Total published: " . $all . "\n";
