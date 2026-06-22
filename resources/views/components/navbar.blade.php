resources/views/components/navbar.blade.php 
<!-- resources/views/components/navbar.blade.php --> 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> 
    <div class="container"> 
        <a class="navbar-brand fw-bold" href="{{ route('home') }}"> 
            🚀 MyLaravelApp 
        </a> 
        <button class="navbar-toggler" type="button" 
                data-bs-toggle="collapse" data-bs-target="#navMenu"> 
            <span class="navbar-toggler-icon"></span> 
        </button> 
        <div class="collapse navbar-collapse" id="navMenu"> 
            <ul class="navbar-nav ms-auto"> 
                <li class="nav-item"> 
                     </li> 
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('about') }}">Giới 
thiệu</a> 
                </li> 
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('articles.index') 
}}">Blog</a> 
                </li> 
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('shop.products') }}">Cửa 
hàng</a> 
                </li> 
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('contact') }}">Liên 
hệ</a> 
                </li> 
            </ul> 
        </div> 
    </div> 
</nav>