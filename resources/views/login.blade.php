@extends('layoutUser')
@section('content')
<div class="container-fluid">
    <!-- Start col -->
    <div class="album py-5" style="height:60vh; margin-top: 4%; margin-bottom: 6%;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card border-success" style="max-width: 35rem;padding: 2%;">
                <h2> Login </h2>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <hr>
                <div class="card-body">
                    <form action="{{route('authenticate')}}" method="POST" name="loginForm" enctype="multipart/from-data">
                        @csrf
                        <div class="form-group">
                            <label for="emailInput">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   required="required" placeholder="Enter email">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="passInput">Password:</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   required="required" placeholder="Password">
                        </div>
                        <br>
                        <center>
                            <input type="submit" name="loginbtn" class="btn btn-outline-success" value="Login">
                            <input type="reset" class="btn btn-outline-danger">
                        </center>
                    </form>
                    <div style="margin-top: -8%;">
                        <a href="{{route('register')}}" class="float-end">New User?</a><br>
                        <a href="#" class="float-end">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('storeLocatore')
@endsection