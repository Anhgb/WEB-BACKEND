# phu-xuan-blog

Blog app xây dựng với Laravel 10 – Bài tập môn IT3042 Đại học Phú Xuân.

## Tính năng
- Quản lý bài viết (CRUD)
- Danh mục, Tag, Comments
- Tìm kiếm, lọc danh mục, sắp xếp
- Phân trang 10 bài/trang

## Cài đặt

```bash
git clone <your-repo-url>
cd phu-xuan-blog
composer install
cp .env.example .env
php artisan key:generate
# Cập nhật DB_DATABASE, DB_USERNAME, DB_PASSWORD trong .env
php artisan migrate:fresh --seed
php artisan serve
```

## Test
- Truy cập `http://localhost:8000/posts`
- Tài khoản test: `admin@phu-xuan-blog.test` / `password`
