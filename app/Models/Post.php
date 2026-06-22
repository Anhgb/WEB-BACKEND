<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    // Bước 2 — $fillable: các cột cho phép mass assignment
    // Khớp đúng với migration Buổi 5 (không có 'body' hay 'is_featured')
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'thumbnail',
        'status',
        'published_at',
        'category_id',
        'user_id',
        'views_count',
        'view_count',
    ];

    // Bước 3 — $casts: tự động chuyển kiểu dữ liệu khi đọc/ghi
    protected $casts = [
        'published_at' => 'datetime',
        'view_count'   => 'integer',
    ];

    // ── Local Scopes ────────────────────────────────
    // Scope: chỉ lấy bài đã published
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Scope: sắp xếp theo phổ biến nhất
    public function scopePopular(Builder $query): Builder
    {
        return $query->orderByDesc('view_count');
    }

    // Scope: bài viết gần đây (mặc định 7 ngày)
    public function scopeRecent(Builder $query, int $days = 7): Builder
    {
        return $query->where('published_at', '>=', now()->subDays($days));
    }

    // Scope: lọc theo danh mục
    public function scopeOfCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    // ── Accessor ────────────────────────────────────
    // Thời gian đọc ước tính (200 từ/phút)
    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: fn () => max(1, (int) ceil(str_word_count(strip_tags($this->content)) / 200)) . " phút đọc",
        );
    }

    // ── Relationships ────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where("is_approved", true);
    }
}
