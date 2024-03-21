@extends('Layout.cdn')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Register</title>

    </head>

    <body class="bg-gradient-primary">

        <div class="container" style="text-align: -webkit-center;">

            <div class="card o-hidden border-0 shadow-lg my-5" style="width: 56vw;">
                <div class="card-body p-0" style="">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Register your account!!</h1>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="user" action="{{ route('register.auth') }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleFirstName" placeholder="username">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="name" class="form-control form-control-user"
                                                id="exampleLastName" placeholder="name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Email Address">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="number" name="nis" class="form-control form-control-user"
                                                id="exampleRepeatPassword" placeholder="NIS">
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>

                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                        Register
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="/">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>

    </html>
@endsection
