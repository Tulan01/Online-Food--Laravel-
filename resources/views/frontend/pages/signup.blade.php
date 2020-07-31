<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>

    <!--Font Awsome-->
    <script
      src="https://kit.fontawesome.com/25ed0a4e62.js"
      crossorigin="anonymous"
    ></script>
    <!--Google Fonts-->
    <link
      href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    />

    <!--CSS Link-->
    <link rel="stylesheet" href="frontend/mycss/mystyle2.css" />
  </head>

  <body>
   <div class="sign-up">
    <section class="logo">
      <div class="container">
        <div class="row mt-3">
          <div class="col-12 d-flex justify-content-center">
          <a href="{{route('index')}}">
            <img src="frontend/myresources/logo.png" class="imh-fluid" alt="" />
          </a>
          </div>
        </div>
      </div>
    </section>
    <section class="sign-up-form">
      <div class="container">
        <div class="row main-form">
          <div class="col-10 col-md-8 back-drop">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                 @csrf
              <div class="form-group pt-2 @error('name') is-invalid @enderror" autocomplete="off">
                <label for="exampleInputEmail1">Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  placeholder="Email"
                  aria-describedby="emailHelp"
                />
              </div>
               @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
              <div class="form-group pt-2 @error('email') is-invalid @enderror" autocomplete="off">
                <label for="exampleInputEmail1">Email address</label>
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  placeholder="Email"
                  aria-describedby="emailHelp"
                />
              </div>
               @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
              <div class="form-group pt-2 pass @error('password') is-invalid @enderror">
                <label for="exampleInputPassword1">Password</label>
                <i
                  id="eye1"
                  class="fas fa-eye"
                  onclick="myFunction1()"
                  style="display: block;"
                ></i>
                <i
                  id="eye-slash1"
                  class="fas fa-eye-slash"
                  onclick="myFunction2() "
                  style="display: none;"
                ></i>
                <input
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="Password"
                  id="myInput1"
                />
              </div>
               @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
              <div class="form-group pt-2 pass @error('password') is-invalid @enderror">
                <label for="exampleInputPassword1">Confirm Password</label>
                <i
                  id="eye2"
                  class="fas fa-eye"
                  onclick="myFunction3()"
                  style="display: block;"
                ></i>
                <i
                  id="eye-slash2"
                  class="fas fa-eye-slash"
                  onclick="myFunction4() "
                  style="display: none;"
                ></i>
                <input
                  type="password"
                  name="password_confirmation"
                  class="form-control"
                  placeholder="Password"
                  id="myInput2"
                />
              </div>
               @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
                <div class="form-group pt-2 @error('image') is-invalid @enderror" autocomplete="off">
                <label for="exampleInputEmail1">Profile Picture</label>
                <input
                  type="file"
                  name="image"
                  class="form-control"
                  placeholder="profile picture"
                />
              </div>
               @error('image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror

              <div
                class="form-group form-check d-flex justify-content-end for-pass"
              >
                <a href="">Forgot Password?</a>
              </div>
               <div class="submit-button d-flex justify-content-center">
                <button class="mr-3 red" type="submit">
                  Sign Up
                </button>
              </form>
               <form action="{{route('login')}}" method="GET">
                <button type="submit" class="white">
                  login
                </button>
              </form>
              </div>

          </div>
        </div>
      </div>
    </section>
   </div>

    <script>
      function myFunction1() {
        var x = document.getElementById("myInput1");
        if (x.type === "password") {
          x.type = "text";
        }
        document.getElementById("eye1").style.display = "none";
        document.getElementById("eye-slash1").style.display = "block";
      }

      function myFunction2() {
        var x = document.getElementById("myInput1");
        if (x.type === "text") {
          x.type = "password";
        }
        document.getElementById("eye1").style.display = "block";
        document.getElementById("eye-slash1").style.display = "none";
      }

      function myFunction3() {
        var x = document.getElementById("myInput2");
        if (x.type === "password") {
          x.type = "text";
        }
        document.getElementById("eye2").style.display = "none";
        document.getElementById("eye-slash2").style.display = "block";
      }

      function myFunction4() {
        var x = document.getElementById("myInput2");
        if (x.type === "text") {
          x.type = "password";
        }
        document.getElementById("eye2").style.display = "block";
        document.getElementById("eye-slash2").style.display = "none";
      }
    </script>
  </body>
</html>
