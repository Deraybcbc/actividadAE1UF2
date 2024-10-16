@extends('Layout.master')


@section('page-style')
    <style>
        body {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
    </style>
@endsection

@section('content')
    <section class="gradient-custom">

        <!--<meta name="csrf-token" content="{{ csrf_token() }}">-->


        <form action="{{ route('login.register') }}" method="POST">
            @csrf

            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h1 class="fw-bold mb-4 text-uppercase">Register</h1>
                                    <p class="text-white-50 mb-5">Please register</p>

                                    <from action="{{ route('login.register')}}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" class="form-control"
                                                id="floatingInputName" placeholder="Username">
                                            <label for="floatingInput" class="text-black">Username</label>
                                        </div>


                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" id="floatingInputEmail"
                                                placeholder="name@example.com">
                                            <label for="floatingInput" class="text-black">Email address</label>
                                        </div>


                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control"
                                                id="floatingPassword" placeholder="Password">
                                            <label for="floatingPassword" class="text-black">Password</label>
                                        </div>


                                        <div class="form-floating">
                                            <input type="password" class="form-control"
                                                id="floatingConfirmPassword" placeholder="Confirm Password">
                                            <label for="floatingConfirmPassword" class="text-black">Confirm Password</label>
                                        </div>

                                        </br>

                                        <button class="btn btn-outline-light btn-lg px-5 v " id="btnRegisterUser" type="submit">Register</button>
                                    </from>

                                </div>

                                <div>
                                    <p class="mb-0">You have an account? <a href=""
                                            class="text-white-50 fw-bold">Login</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
