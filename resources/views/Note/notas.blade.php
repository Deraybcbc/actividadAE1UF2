@extends('Layout.master')

@section('page-style')
    <style>
        nav {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252))
        }
    </style>
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="https://cdn-icons-png.flaticon.com/512/3771/3771133.png" class="rounded" style="width: 40px">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav w-100">

                    <li class="nav-item d-flex align-items w-100 text-center">
                        <a class="navbar-brand w-100 text-white" href="#">Notas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="color: white">
                            <i class="bi bi-list fs-4" style="color: white"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Usuario</a></li>
                            <li><a class="dropdown-item" href="#">Categorías</a></li>
                            <li><a class="dropdown-item" href="#">Cerrar Session</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('pages')
    <h1>{{ $note->title }}</h1>
    <p>{{ $note->desc }}</p>

    <a href="{{ route('category.index') }}">Volver a la lista de notas</a>
@endsection
