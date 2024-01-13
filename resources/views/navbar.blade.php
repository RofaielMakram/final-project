<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="{{ url('/') }}" class="navbar-brand p-0 d-flex align-items-center py-2">
        <x-application-logo />
        <h1 class="m-0">{{ config('app.name') }}</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse my-4" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-0">
            <!-- <a href="index.html" class="nav-item nav-link active">Home</a> -->
        </div>
        @auth
            <a href="{{ route('projects.index') }}" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Login</a>
        @else
            <a href="{{ route('login') }}" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Login</a>
            <a href="{{ route('register') }}" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Register</a>
        @endauth
    </div>
</nav>
