 <header id="top-bar" class="clearfix trans">
        <style>
.dropbtn1 {
 
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown1-content {
  display: none;
  position: absolute;
  left: 30%;
  background-color: black;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown1-content a {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}


.show {display: block;}
</style>

<style type="text/css">
  .btn1 {
  display: inline-block;
  padding: 6px 40px;
  background-color: red;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
}
</style>
<style type="text/css">
  .progimg {
  border-radius: 50%;
}
</style>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
          <div class="container">
            <div class="inner-navbar">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button
                  type="button"
                  class="navbar-toggle collapsed"
                  data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1"
                >
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('index')}}">
                  <img src="frontend/myresources/logo.png" alt="" />
                </a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div
                class="collapse navbar-collapse"
                id="bs-example-navbar-collapse-1"
              >
                <ul class="nav navbar-nav navbar-right navigate-section">
                  @guest
                   <?php $active=Session::get('active');
                    $noti=Session::get('noti');
                    ?>
                   <?php if($active==1){ ?>
                  <li><a class="active" href="{{route('index')}}">Home</a></li>
                   <?php } else { ?>
                  <li><a href="{{route('index')}}">Home</a></li>
                   <?php } ?>

                  <?php if($active==2){ ?>
                   <li><a class="active" href="{{route('menu')}}">Menu</a></li>
                   <?php } else { ?>
                  <li><a href="{{route('menu')}}">Menu</a></li>
                   <?php } ?>

                   <?php if($active==3){ ?>
                   <li><a class="active" href="{{route('order')}}">Order</a></li>
                   <?php } else { ?>
                   <li><a href="{{route('order')}}">Order</a></li>
                   <?php } ?>
                   
                   <?php if($active==4){ ?>
                   <li><a class="active" href="{{route('subscription')}}">Subscription</a></li>
                   <?php } else { ?>
                   <li><a href="{{route('subscription')}}">Subscription</a></li>
                   <?php } ?>
                 
                  @if (Route::has('register'))
                  <li><a href="{{route('login')}}">Login</a></li>
                  <li><a href="{{route('register')}}">Register</a></li>
                  @endif
                   <?php if($active==5){ ?>
                   <li><a class="active"  href="{{route('showcart')}}"
                      onmouseover="mouseover()"
                      onmouseout="mouseout()"
                      area-hiden="false"
                      ><i class="fas fa-shopping-cart"><span class="badge badge-danger" id="notific" style="background-color: red;"></i></a></li>
                   <?php } else { ?>
                    <?php if($noti==0){ ?>
                    <li><a href="{{route('showcart')}}"
                      onmouseover="mouseover()"
                      onmouseout="mouseout()"
                      area-hiden="false"
                      ><i class="fas fa-shopping-cart"><span class="badge badge-danger" id="notific" style="background-color: red;"></span></i></a></li>
                      <?php } else{ ?>
                       <li><a href="{{route('showcart')}}"
                      onmouseover="mouseover()"
                      onmouseout="mouseout()"
                      area-hiden="false"
                      ><i class="fas fa-shopping-cart"><span class="badge badge-danger" id="notific" style="background-color: red;">{{$noti}}</span></i></a></li>
                     <?php } 
                            } ?>
                  
                  @else

                 <?php $active=Session::get('active');
                    $noti=Session::get('noti'); ?>
                   <?php if($active==1){ ?>
                  <li><a class="active" href="{{route('index')}}">Home</a></li>
                   <?php } else { ?>
                  <li><a href="{{route('index')}}">Home</a></li>
                   <?php } ?>

                  <?php if($active==2){ ?>
                   <li><a class="active" href="{{route('menu')}}">Menu</a></li>
                   <?php } else { ?>
                  <li><a href="{{route('menu')}}">MENU</a></li>
                   <?php } ?>

                   <?php if($active==3){ ?>
                   <li><a class="active" href="{{route('order')}}">Order</a></li>
                   <?php } else { ?>
                   <li><a href="{{route('order')}}">Order</a></li>
                   <?php } ?>
                   
                   <?php if($active==4){ ?>
                   <li><a class="active" href="{{route('subscription')}}">Subscription</a></li>
                   <?php } else { ?>
                   <li><a href="{{route('subscription')}}">Subscription</a></li>
                   <?php } ?>

                   <?php if($active==5){ ?>
                   <li><a class="active"  href="{{route('showcart')}}"
                      onmouseover="mouseover()"
                      onmouseout="mouseout()"
                      area-hiden="false"
                      ><i class="fas fa-shopping-cart"><span class="badge badge-danger" id="notific" style="background-color: red;"></i></a></li>
                     <?php } else { ?>
                    <?php if($noti==0){ ?>
                    <li><a href="{{route('showcart')}}"
                      onmouseover="mouseover()"
                      onmouseout="mouseout()"
                      area-hiden="false"
                      ><i class="fas fa-shopping-cart"><span class="badge badge-danger" id="notific" style="background-color: red;"></span></i></a></li>
                      <?php } else{ ?>
                       <li><a href="{{route('showcart')}}"
                      onmouseover="mouseover()"
                      onmouseout="mouseout()"
                      area-hiden="false"
                      ><i class="fas fa-shopping-cart"><span class="badge badge-danger" id="notific" style="background-color: red;">{{$noti}}</span></i></a></li>
                     <?php } 
                            } ?>

                    <li >
                      <a onclick="myFunction1()" class="dropbtn1"><img class="progimg" src="{{URL::to(Auth::user()->image)}}" style="width: 30px; height: 25px;"></a>
                        <div id="myDropdown" class="dropdown1-content">
                          <div>
                          <a>{{Auth::user()->name}}</a>
                          <a href="{{route('reserve')}}">My Order</a>
                          <a href="#contact" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><button class="btn1 btn-outline-dark">Log Out</button></a>
                          </div>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                          </form>
                        </div>
                         
                   </li>
                   @endguest
                 
                </ul>
              </div>

              <!-- /.navbar-collapse -->
              <div
                id="drop-cart"
                class="dropdown-content log"
                onmouseover="mouseover()"
                onmouseout="mouseout()"
              >   
              <?php 
                  
              $contents=Cart::getContent();
              $subtotal = Cart::getSubTotal();
               ?>
              <div id="log">
                @foreach($contents as $content)
                <div class="item{{$content->id}}">
                <div class="dropdown-content-list-1 ">
                  <div>
                    <img src="{{URL::to($content->attributes->image)}}" style="width: 40px; height: 40px;" alt="" />
                  </div>

                  <div>
                    <h5><span class="dunit">{{$content->price}}</span>&nbspBDT</h5>
                  </div>
                  <div>
                    <h5>X <span class="dquantity">{{$content->quantity}}</span></h5>
                  </div>
                  <div>
                    <h5><span class="damount">{{$content->price*$content->quantity}}</span>&nbspBDT</h5>
                  </div>
                  <div class="">
                   <i class="fas fa-trash" onclick="deletecart({{$content->id}})" ></i>
                  </div>
                </div>
               </div>
                @endforeach
               </div>
                <div class="drop-sub-total">
                  <div>
                    <h5>Total</h5>
                  </div>
                  <div>
                    <h5><span class="drop-total">{{$subtotal}}</span>&nbspBDT</h5>
                  </div>
                </div>
                <div class="view-cart">
                  <button onClick="window.location='{{route('showcart')}}';">View Cart</button>
                </div>
                <div class="check-out">
                  <button onClick="window.location='{{route('checkout')}}';">Checkout</button>
                </div>
              </div>


            </div>
          </div>
          <!-- /.container -->
        </nav>


        <script type="text/javascript">
          function deletecart(id){
              $.ajax({
            url:"{{URL::to('deletecart')}}",
            method:"POST",
            data:{
              id:id,
              _token:  "{{ csrf_token() }}"
            },
           dataType:"json",
           success:function(data){
           console.log(data);
             $('.item'+data.id).remove();
             $('.item1'+data.id).remove();
             
             $('.drop-sub-total').replaceWith("<div class='drop-sub-total'><div><h5>Total</h5></div><div><h5><span class='drop-total'>"+data.total+"</span>&nbspBDT</h5></div></div>");
             $('.sub-total-sec-two').replaceWith("<div class='sub-total-sec-two'><h5><span class='stotal'>"+data.total+"</span>&nbsp BDT</h5><h5>0 &nbsp &nbsp&nbsp BDT</h5><h5><span class='total'>"+data.total+"</span>&nbsp BDT</h5></div>");
             
              $('.right').replaceWith("<div class='right'><h4>"+data.total+" BDT</h4><h4>0 BDT</h4><h4>"+data.total+" BDT</h4></div>");
              
               $('#notific').html(data.noti);

              
              
            /* var dataObject = data;
             $.each(dataObject, function(){
                $('#log').replaceAll("<div><img src='"+this.attributes.image+"' style='width: 100px; height: 100px;'>");
               });*/
         }
      });
  
          }
        </script>








        <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction1() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

      </header>
