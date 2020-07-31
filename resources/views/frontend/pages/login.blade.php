<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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

    <title>Food Login</title>
  </head>

  <body>
   <div class="login">
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
    <section class="login-form">
      <div class="container">
        <div class="row main-form">
          <div class="col-10 col-md-8 back-drop">
            <form method="POST" action="{{ route('login') }}">
            	 @csrf
              <div class="form-group pt-2 @error('email') is-invalid @enderror" autocomplete="off">
                <label for="exampleInputEmail1">Email address</label>
                <input
                  type="email"
                  class="form-control @error('email') is-invalid @enderror"
                  name='email'
                  id="exampleInputEmail1"
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
                  id="eye"
                  class="fas fa-eye"
                  onclick="myFunction()"
                  style="display: block;"
                ></i>
                <i
                  id="eye-slash"
                  class="fas fa-eye-slash"
                  onclick="myFunction1() "
                  style="display: none;"
                ></i>
                <input
                  type="password"
                  class="form-control @error('password') is-invalid @enderror"
                  name='password'
                  placeholder="Password"
                  id="myInput"
                />
              </div>
               @error('password')
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
                  Login
                </button>
              </form>
               <form action="{{route('register')}}" method="GET">
                <button type="submit" class="white">
                  Sign Up
                </button>
              </form>
              </div>
             
          </div>
        </div>
      </div>
    </section>
   </div>
    <script>
      function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        }
        document.getElementById("eye").style.display = "none";
        document.getElementById("eye-slash").style.display = "block";
      }

      function myFunction1() {
        var x = document.getElementById("myInput");
        if (x.type === "text") {
          x.type = "password";
        }
        document.getElementById("eye").style.display = "block";
        document.getElementById("eye-slash").style.display = "none";
      }
    </script>
    <script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        var url = "http://www.youtube.com";
              window.location(url);
    };
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>
