 
@extends('layout.backend.masterlogin')
@section('contact')
    <div class="wrapper-page">
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="{{route('admin')}}" class="logo logo-admin"><img src="frontend/myresources/logo.png" height="100" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Free Register</h4>
                        <p class="text-muted text-center"></p>

                        <form class="form-horizontal m-t-30" action="{{route('adminregister')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <div class="form-group">
                                <label for="username">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            </div>

                            <div class="form-group">
                                <label for="useremail">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            </div>
                            <div class="form-group">
                                <label for="userpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                            </div>
                             <div class="form-group">
                                <label for="username">Select Picture</label>
                                <input type="file" class="form-control" id="image" name="image" placeholder="Confirm password">
                            </div>
                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <p class="font-14 text-muted mb-0">By registering you agree to the Agroxa <a href="#" class="text-primary">Terms of Use</a></p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="text-muted">Already have an account ? <a href="pages-login.html" class="text-white"> Login </a> </p>
                <p class="text-muted">© 2018 Agroxa. Crafted with <i class="mdi mdi-heart text-primary"></i> by Themesbrand</p>
            </div>
        </div>


        @endsection