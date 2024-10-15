@extends('Layout.master')

@section('page-style')
    <style>
        nav {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }

        body {
            background-color: rgb(255, 255, 255);
            /* Fondo para toda la página */
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
                        <a class="navbar-brand w-100 text-white" href="#">Categorías</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="color: white">
                            <i class="bi bi-list fs-4" style="color: white"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Usuario</a></li>
                            <li><a class="dropdown-item" href="#">Cerrar Session</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('pages')
    <!-- Alertas para mensajes de éxito o error -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" style="" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('category.index') }}" method="POST">
        @csrf

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div style="display: flex; flex-wrap: wrap; justify-content: flex-start;" id="AllCategory">

            <button class="btnCreateCategory" type="button"
                style="width: 9cm; height: 11cm; display: flex; border: 1px solid black; margin: 10px; color: black; text-align: center; line-height: 4rem; justify-content:center; align-items:center; cursor: pointer;">

                <i class="bi bi-plus-circle" style="font-size: 3rem; color:grey"></i>

            </button>

            @foreach ($categories as $category)
                <a
                    style="width: 9cm; height: 11cm; display: inline-block; border: 1px solid black; margin: 10px; color: black; text-align: center; line-height: 4rem; overflow:hidden">

                    <form method="POST" action="{{ route('category.delete', ['id' => $category->id]) }}"
                        class="form-delete-{{ $category->id }}">
                        @csrf
                        @method('DELETE')
                    </form>

                    <p style="border: 1px solid black; background-color:#60348f; color:white ">

                        <button class="btn btn-secondary  btnDeleteCategory" type="button">
                            <i class="bi bi-trash" style="cursor:pointer; color: white;"
                                data-id-category="{{ $category->id }}"></i>
                        </button>

                        <button class="btn btn-primary  btnUpdateCategory" type="button"
                            data-id-category="{{ $category->id }}" data-name="{{ $category->name }}">
                            <i class="bi bi-pencil" style="cursor: pointer;"></i>
                        </button>

                        <span style="display: inline-block; margin: 0 auto;">{{ $category->name }}</span>

                        {{-- <i class="bi bi-plus-circle" style="margin-left:30px;  cursor: pointer;" data-bs-toggle="modal"
                            data-bs-target="#createNote{{ $category->id }}"></i> --}}
                        <button class="btn btn-secondary btnCreateNote" type="button"
                            data-id-category="{{ $category->id }}">
                            <i class="bi bi-plus-circle" style="color: white;  cursor: pointer;"></i>
                        </button>

                    </p>



                    <ul style="list-style-type: none; padding:0; margin:0; max-height:10cm; overflow-y:auto; ">

                        @forelse ($category->notes as $note)
                            <li style="margin: 6px;">
                                <div
                                    style="display: flex; flex-direction: column; justify-content: center; align-items: flex-start; border: 1px solid black; border-radius: 20px; background-color: rgba(179, 179, 5, 0.384); cursor: pointer; width: 96%; padding: 10px; position: relative;">

                                    <span
                                        style="overflow: hidden; white-space: normal; text-overflow: ellipsis; max-width: calc(100% - 50px);">
                                        {{ $note->title }}
                                    </span>

                                    <form method="POST" action="{{ route('note.delete', ['id' => $note->id]) }}"
                                        class="form-delete-{{ $note->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>


                                    <div style="position: absolute; right: 10px; bottom: 10px;">

                                        <button class="btn btn-primary btnUpdateNote" type="button"
                                            data-id-note="{{ $note->id }}" data-title="{{ $note->title }}"
                                            data-desc="{{ $note->desc }}">
                                            <i class="bi bi-pencil" style="cursor: pointer;"></i>
                                        </button>

                                        <button class="btn btn-secondary btnDeleteNote" type="button"
                                            data-id-note="{{ $note->id }}">
                                            <i class="bi bi-trash" style="cursor: pointer;"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>

                            {{-- <form action="{{ route('note.delete', [$note->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal fade" id="deleteNote{{ $note->id }}" tabindex="-1"
                                    aria-labelledby="deleteNote" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteNote">Eliminar nota</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar esta nota?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                    style="background-color: red">Cancelar</button>
                                                <button type="submit" class="btn btn-primary"
                                                    style="background-color: green">Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form> --}}

                        @empty
                            <li
                                style="margin: 6px; border: 1px solid black; border-radius: 20px; background-color: rgba(179, 179, 5, 0.384); width: 96%; text-align: left; border: none; padding: 10px; display: block;">
                                No hay notas
                            </li>
                        @endforelse
                    </ul>


                    {{-- <!-- Formularios -->
                    <form action="{{ route('category.delete', [$category->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                            aria-labelledby="deleteModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteModal">Eliminar categoría</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar esta categoría?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            style="background-color: red">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"
                                            style="background-color: green">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> --}}


                    {{-- <form action="{{ route('category.update', [$category->id]) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Specify PUT method -->

                        <div class="modal fade" id="updateModal{{ $category->id }}" tabindex="-1"
                            aria-labelledby="UpdateModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar nombre de la categoría
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Input field for the new category name -->
                                        <input type="text" name="name" id="newName"
                                            style="width: 100%; height: 2rem;" placeholder="Nuevo nombre de la categoría"
                                            value="{{ $category->name }}" required />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            style="background-color: red">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"
                                            style="background-color: green">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> --}}

                    {{-- <form action="{{ route('note.create', [$category->id]) }}" method="POST">
                        @csrf
                        <div class="modal fade" id="createNote{{ $category->id }}" tabindex="-1"
                            aria-labelledby="createNote" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="createNote">{{ $category->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Deseas crear una nueva nota?</p>
                                        <input type="text" name="title" id="newName"
                                            style="width: 100%; height: 2rem;" placeholder="Titulo de la nota" required />
                                        <textarea name="desc" rows="3" cols="50" placeholder="Descripción"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            style="background-color: red">Cancelar</button>
                                        <button type="submit" class="btn btn-primary " id="btnCreateNote"
                                            style="background-color: green">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                </a>
            @endforeach

        </div>
    </form>
@endsection

@section('forms-cruds')
    {{-- <form action="{{ route('category.create') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir nueva categoría</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" id="categoryName" style="width: 100%; height: 2rem;"
                            placeholder="Nombre de la categoría" required />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="background-color: red">Cancelar</button>
                        <button type="submit" class="btn btn-primary" style="background-color: green">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </form> --}}

    <div class="modal fade" id="modal-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir nueva categoría</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> --}}
                <form method="POST" id="form-category">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="name" id="categoryName" style="width: 100%; height: 2rem;"
                            placeholder="Nombre de la categoría" required />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="background-color: red">Cancelar</button>
                        <button type="submit" class="btn btn-primary" style="background-color: green">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-notes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir nueva categoría</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> --}}
                <form method="POST" id="form-note">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="title" id="newName" style="width: 100%; height: 2rem;"
                            placeholder="Titulo de la nota" required />
                        <textarea name="desc" id="newDesc" placeholder="Descripción"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="background-color: red">Cancelar</button>
                        <button type="submit" class="btn btn-primary" style="background-color: green">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/categorias.js') }}"></script>
@endsection
