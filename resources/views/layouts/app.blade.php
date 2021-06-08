<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="{{ mix('/js/app.js') }}" defer></script>
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="root" id="app">
            <header class="p-3 mb-3 border-bottom">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                            <strong>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg> <i>Microblog</i></strong>
                        </a>
                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                            {{-- <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
                            <li><a href="#" class="nav-link px-2 link-dark">Inventory</a></li>
                            <li><a href="#" class="nav-link px-2 link-dark">Customers</a></li>
                            <li><a href="#" class="nav-link px-2 link-dark">Products</a></li> --}}
                        </ul>
                        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                        </form>
                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            
            <newsfeed-component></newsfeed-component> 
        </div>
    </body>
</html>