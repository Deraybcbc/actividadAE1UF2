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

    <!--<meta name="csrf-token" content="{{csrf_token()}}">-->

  
    <form action="{{route('login.user')}}"
    method="POST">
    @csrf

    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
  
              <div class="mb-md-5 mt-md-4 pb-5">
  
                <h1 class="fw-bold mb-4 text-uppercase">Login</h1>
                <p class="text-white-50 mb-5">Please enter your login and password!</p>

                @if ($errors->has('email'))

                <div class="alert alert-danger">
                    {{$errors->first('email')}}
                </div>
                
            @endif

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput" class="text-black">Email address</label>
                </div>
                  
  
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword" class="text-black">Password</label>
                </div>
            
            </br>
  
                <button class="btn btn-outline-light btn-lg px-5 v" type="submit" >Login</button>
  
              </div>
  
              <div>
                <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
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

@section('script-login')
<!--<script src="{{asset('js/login.js')}}"></script>-->
@endsection
