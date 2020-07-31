@extends('layout.frontend.master')
@section('contact') 

<style type="text/css">
  .progimg1 {
  border-radius: 50%;
}
</style>

     <?php $i=0;?>
      <div class="subscription">
        <div class="grid-container">
            <div id="sec-one" class="grid-item-1 subscription-left">
              @foreach($subscrip as $sub)
              <div onclick="getid({{$i}})" class="sub-box">
                <h4>Daily Subscription <span class="dot-green"></span></h4>
                <h6>{{$sub->start_date}} - {{$sub->start_date}}</h6>
                <h5>Total Amount : <span>{{$sub->price}}</span></h5>
              </div>
              <?php $i=$i+1; ?>
              @endforeach
            </div>
         
         <?php $j=0 ?>
         @foreach($subscrip as $sub)
          <div id="sec-two" class="grid-item-2 subscription-right wow bounceInRight showhide{{$j}}" style="display: none;">
           <div class="description">
              <h4></h4>
              <h6>Duration : <span> &nbsp {{$sub->start_date}} - {{$sub->end_date}}</span></h6>
               <h6>Subscription Cycle: &nbsp
                <?php $a=json_decode($sub->days_id)?>
                @foreach($a as $key )
                <?php  $d=DB::table('days')->where('id',$key)->first(); 
                       $d1=DB::table('days_menus')->where('days_id',$key)->first();
                ?> 
                <span class="s">{{$d->days_name_short}}</span>
                @endforeach
                </h6>
              <h6>Total Price : &nbsp{{$sub->price}}</h6>
            </div>

          
            <div class="grid-container-two">
               @foreach($a as $key )
                <?php  $d=DB::table('days')->where('id',$key)->first(); 
                       $d1=DB::table('days_menus')->where('days_id',$key)->first();
                ?> 
              <div class="grid-item-two">
                <h6>{{$d->days_name}}</h6>
              </div>
              <div class="grid-item-two">
                <h6>{!! html_entity_decode($d1->days_menu_details) !!}</h6>
              </div>
              <div class="grid-item-two">
                <h6><img class="progimg" src="{{URL::to($d1->days_menu_image)}}" style="height: 80px; width: 80px;"></h6>
              </div>
              
               @endforeach
            </div>
          </div>
       <?php $j=$j+1; ?>
         @endforeach



          <div class="add" id="add">
            <i class="fas fa-plus"></i>
          </div>
        </div>

        <div id="menuModal" class="modal-one">
          <!-- Modal content -->
          <div class="modal-content-one">
            <span class="close">&times;</span>

            <div class="swiper-container">

              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
           @foreach($data as $row)
                <div id="sunday" class="swiper-slide">
                  <div class="sunday text-center">
                    <h1>{{$row->days_name}}</h1>
                    <p>
                      {!! html_entity_decode($row->days_menu_details) !!}
                    </p>
                    <p>
                      {{$row->days_menu_price}}
                    </p>
                    <img class="progimg1" src="{{URL::to($row->days_menu_image)}}" style="width: 130px; height: 130px;"
                      class="img-fluid"
                      alt=""
                    />
                  </div>
                </div>
           @endforeach
                
              </div>

              <!-- If we need navigation buttons -->
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

         <form action="{{route('subsadd')}}" method="POST">
           @csrf
            <div class="week">
              <ul>
                <?php 
                $c=1;
                ?>
                @foreach($days as $day)
                <input type="checkbox" id="myCheck{{$c}}" name="days_id[]" value="{{$day->id}}" style="display: none;" required><li id="d{{$c}}">{{$day->days_name_short}}</li>
                <?php $c=$c+1; ?>
                @endforeach
              </ul>
            </div>

            <div class="from">
              <!-- datedropper-init class -->
              <i class="fas fa-calendar-alt"></i>

              <input
                type="text"
                name='start_date'
                data-datedropper
                data-dd-modal="true"
                data-dd-format="d M Y"
                placeholder="DD-MM-YY"
                required
              />
              <!-- data-datedropper attribute -->
              <h5>TO</h5>

              <i class="fas fa-calendar-alt"></i>

              <input
                type="text"
                name="end_date"
                data-datedropper
                data-dd-modal="true"
                data-dd-format="d M Y"
                placeholder="DD-MM-YY"
                required
              />
            </div>

            <div class="confirm">
               <button type="submit" id="confirm">
                Confirm
              </button>
            </div>
          </form>
          </div>
        </div>
      </div>

        

   <script type="text/javascript">

    var d = <?php echo $i ?>;
      console.log(d);
          function getid(id){
          for(var i=0 ; i<d ;i++){
                console.log(i);
              if ( id == i)
              {  
                $('.showhide'+i).show();
              }
              else{
                 $('.showhide'+i).hide();
              }
             }
          }
        </script>


        <script>
      // Get the modal
      var modal = document.getElementById("menuModal");

      // Get the button that opens the modal
      var btn = document.getElementById("add");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal
      btn.onclick = function () {
        modal.style.display = "block";
        document.getElementById("top-bar").style.position = "fixed";
      };

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        modal.style.display = "none";
      };

      //When the user clicks anywhere outside of the modal, close it
     

      $(document).ready(function () {
        //initialize swiper when document ready
        var swiper = new Swiper(".swiper-container", {
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },

          slidesPerView: 4,
          spaceBetween: 3,
          loop: true,
          centeredSlides: true,
          observer: true,
          observeParents: true,
        });
      });

      var btnContainer = document.getElementById("sec-one");

      // Get all buttons with class="btn" inside the container
      var btns = btnContainer.getElementsByClassName("sub-box");

      // Loop through the buttons and add the active class to the current/clicked button
      for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
          new WOW().init();
          var current = btnContainer.getElementsByClassName("active");

          // If there's no active class
          if (current.length > 0) {
            current[0].className = current[0].className.replace(" active", "");
          }

          // Add the active class to the current/clicked button
          this.className += " active";
        });
      }

         $('#d1').click(function() {     
           var checked = $('#myCheck1').is(':checked');
           console.log(checked);
           if(checked==true){
            $('#myCheck1').prop('checked', false);
           }else{
             $('#myCheck1').prop('checked', true);
           } 
          });
  
       document.getElementById("d1").addEventListener("click", function () {
          if (document.getElementById("d1").style.color == "red") {
          document.getElementById("d1").style.color = "white";
        } else {
          document.getElementById("d1").style.color = "red";
        }
      });
        
         $('#d2').click(function() {     
           var checked = $('#myCheck2').is(':checked');
           console.log(checked);
           if(checked==true){
            $('#myCheck2').prop('checked', false);
           }else{
             $('#myCheck2').prop('checked', true);
           } 
          });
     
      document.getElementById("d2").addEventListener("click", function () {
        if (document.getElementById("d2").style.color == "red") {
          document.getElementById("d2").style.color = "white";
        } else {
          document.getElementById("d2").style.color = "red";
        }
      });

      $('#d3').click(function() {     
           var checked = $('#myCheck3').is(':checked');
           console.log(checked);
           if(checked==true){
            $('#myCheck3').prop('checked', false);
           }else{
             $('#myCheck3').prop('checked', true);
           } 
          });
     

      document.getElementById("d3").addEventListener("click", function () {
        if (document.getElementById("d3").style.color == "red") {
          document.getElementById("d3").style.color = "white";
        } else {
          document.getElementById("d3").style.color = "red";
        }
      });

      $('#d4').click(function() {     
           var checked = $('#myCheck4').is(':checked');
           console.log(checked);
           if(checked==true){
            $('#myCheck4').prop('checked', false);
           }else{
             $('#myCheck4').prop('checked', true);
           } 
          });
     

      document.getElementById("d4").addEventListener("click", function () {
        if (document.getElementById("d4").style.color == "red") {
          document.getElementById("d4").style.color = "white";
        } else {
          document.getElementById("d4").style.color = "red";
        }
      });

     $('#d5').click(function() {     
           var checked = $('#myCheck5').is(':checked');
           console.log(checked);
           if(checked==true){
            $('#myCheck5').prop('checked', false);
           }else{
             $('#myCheck5').prop('checked', true);
           } 
          });
     

      document.getElementById("d5").addEventListener("click", function () {
        if (document.getElementById("d5").style.color == "red") {
          document.getElementById("d5").style.color = "white";
        } else {
          document.getElementById("d5").style.color = "red";
        }
      });

      $('#d6').click(function() {     
           var checked = $('#myCheck6').is(':checked');
           console.log(checked);
           if(checked==true){
            $('#myCheck6').prop('checked', false);
           }else{
             $('#myCheck6').prop('checked', true);
           } 
          });
     

      document.getElementById("d6").addEventListener("click", function () {
        if (document.getElementById("d6").style.color == "red") {
          document.getElementById("d6").style.color = "white";
        } else {
          document.getElementById("d6").style.color = "red";
        }
      });
      $('#d7').click(function() {     
           var checked = $('#myCheck7').is(':checked');
           console.log(checked);
           if(checked==true){
            $('#myCheck7').prop('checked', false);
           }else{
             $('#myCheck7').prop('checked', true);
           } 
          });
     

      document.getElementById("d7").addEventListener("click", function () {
        if (document.getElementById("d7").style.color == "red") {
          document.getElementById("d7").style.color = "white";
        } else {
          document.getElementById("d7").style.color = "red";
        }
      });

      function back() {
        document.getElementById("sec-one").style.display = "block";
        document.getElementById("sec-two").style.display = "none";
      }
      $(function () {
        $(".datepicker").datepicker();
      });

      $(".datepicker").datepicker({
        dateFormat: "dd-MM",
      });

      function mouseover() {
        document.getElementById("drop-cart").style.display = "block";
      }
      function mouseout() {
        document.getElementById("drop-cart").style.display = "none";
      }

      var dropCartItem = document.getElementsByClassName("sec-dlt");
      for (var i = 0; i < dropCartItem.length; i++) {
        var button = dropCartItem[i];
        button.addEventListener("click", removeDropCartItem);
      }

      function removeDropCartItem(event) {
        var buttonClicked = event.target;
        buttonClicked.parentElement.parentElement.remove();
        updateDropCartTotal();
      }

      function updateDropCartTotal() {
        var cartItemContainer = document.getElementsByClassName("dropdown-content")[0];
        var cartRows = cartItemContainer.getElementsByClassName("dropdown-content-list-1");

        var total = 0;

        for (i = 0; i < cartRows.length; i++) {
          var cartRow = cartRows[i];
          var priceElement = cartRow.getElementsByClassName("dunit")[0];
          var quantityElement = cartRow.getElementsByClassName(
            "dquantity"
          )[0];
          
          var price = parseFloat(priceElement.innerText.replace("BDT", ""));
         
          var quantity = parseFloat(quantityElement.innerText);
        
        

          document.getElementsByClassName("damount")[i].innerText =
            price * quantity;
          total = total + price * quantity;
        }
        document.getElementsByClassName("drop-total")[0].innerText = total;
      
      }
    
    </script>

  
@endsection
