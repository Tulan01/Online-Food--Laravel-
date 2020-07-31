@extends('layout.frontend.master')
@section('contact')
<style type="text/css">
	.modal-header{
		 background: linear-gradient(60deg, #3e0000, #7c0000);
	}
	.modal-title{
		  color: white;
	      text-align: center;
	}

.progimg1 {
  border-radius: 50%;
}

</style>

      <?php $i=0;
            $od_id=0;?>
      <div class="subscription">
        <div class="grid-container">
            <div id="sec-one" class="grid-item-1 subscription-left">
              @foreach($order as $order)
              <?php $od_id=$order->id ?>
              <div onclick="getid({{$i}})" class="sub-box">
                <h4>Your Order<span class="dot-green"></span></h4>
                <h6>Order Status : <span>{{$order->order_status}}</span></h6>
                <?php if($order->order_status=='Cancelled'){ ?>

              <?php } else{ ?>
                 <h6><button class="btn1" data-toggle="modal" data-target="#confirmModal"  type="submit">
                  Cancel
                </button></h6>
             <?php } ?>
              </div>
              
              <?php $i=$i+1; ?>
              @endforeach
            </div>




              <?php $order1=DB::table('orders')->get(); ?>


         <?php $j=0 ?>
         @foreach($order1 as $row)
          <div id="sec-two" class="grid-item-2 subscription-right wow bounceInRight showhide{{$j}}" class="" style="display: none;">
            
             <h2>Your Order</h2>
             <div class="container">
            <table style="font-size: 2rem;">
              <tr >
                <th>Products Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Photo</th>
              </tr>
              <?php $details1=DB::table('orders')
                      ->join('order_details','orders.id','order_details.order_id')
                      ->join('menu_items','order_details.item_id','menu_items.id')
                      ->select('orders.*','order_details.order_id','order_details.item_id','order_details.item_quantity','order_details.item_amount','menu_items.item_name','menu_items.item_image','menu_items.item_price')
                      ->where('orders.id',$row->id)
                      ->where('orders.user_id',Auth::user()->id)
                      ->get(); ?>
              @foreach($details1 as $details)
              <tr >
                <td>{{$details->item_name}}</td>
                <td>{{$details->item_quantity}}</td>
                <td>{{$details->item_price}}</td>
                <td><img class="progimg1" src="{{URL::to($details->item_image)}}" style="width: 50px; height: 50px; "></td>
              </tr>
             @endforeach
               <tr>
                  <td></td>
                  <td>Total = </td>
                  <td>{{$row->total_amount}}</td>
                  <td></td>
               </tr>
            </table>
          </div>
             <hr>
              <?php $address=DB::table('delivery_addressses')->where('order_id',$row->id)
                                                             ->first(); ?>
              <h2>Your Address</h2>                                 
              <div class="container" >

              <div align="left">
                <h6>Order Status : {{$row->order_status}}</h6>
                <h6>ADDRESS: {{$address->add2}},{{$address->add}} </h6>
                <h6>CITY : {{$address->city}} </h6>
                <h6>Country : {{$address->country}}</h6>
                <h6>Post code : {{$address->post_code}}</h6>
              </div>
            </div>
          </div>
       <?php $j=$j+1; ?>
         @endforeach

           

     </div>
   </div>

  <div class="modal fade" id="confirmModal"  role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CONFIRM !!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Are You Sure Want To Cancel The Order ?</b>
      </div>
      <div class="modal-footer">
      	<form action="{{route('cancelorder')}}" method="POSt">
      		@csrf
      	<input type="hidden" name="order_id" value="{{$od_id}}">
        <button type="submit"  class="btn btn-danger">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </form>
      </div>
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