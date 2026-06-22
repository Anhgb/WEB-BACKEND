<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực hành Named Routes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 60px 20px; text-align: center; }
        .card { transition: transform 0.3s, box-shadow 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.2) !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}"><i class="bi bi-star"></i> Phu Xuan Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Giới Thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('shop.products') }}">Sản Phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Liên Hệ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1 class="display-5 fw-bold"><i class="bi bi-star"></i> Chào mừng bạn MyBrandTag</h1>
        <p class="lead">Tìm hiểu thêm bài viết và <a href="{{ route('articles.index') }}" class="text-white fw-bold">Bài Viết</a></p>
    </section>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card b-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-bag"></i> Cửa Hàng</h5>
                        <p class="card-text">Khám phá các sản phẩm nổi bật trong cửa hàng</p>
                        <a href="{{ route('shop.products') }}" class="btn btn-secondary">Xem</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card b-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-newspaper"></i> Bài Viết</h5>
                        <p class="card-text">Đọc các bài viết thú vị từ blog của chúng tôi</p>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Xem</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card b-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-telephone"></i> Liên Hệ</h5>
                        <p class="card-text">Có câu hỏi? Hãy liên hệ với chúng tôi</p>
                        <a href="{{ route('contact') }}" class="btn btn-secondary">Xem</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center py-4 mt-5">
        <p class="mb-0">&copy; 2024 Phu Xuan Blog. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>