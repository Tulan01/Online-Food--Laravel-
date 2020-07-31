@extends('layout.frontend.master')
@section('contact') 

  		<div class="cart">
          <div class="item-list">

          @foreach($contents as $content)
          <div class="item1{{$content->id}}">
            <div class="cart-item">
              <div class="sec-one">
                <img src="{{URL::to($content->attributes->image)}}" style="width: 100px; height: 100px" alt="" />
              </div>
              <div class="sec-two">
                <h5>{{$content->name}}</h5>
              </div>

              <div class="unit">
                <h5>{{$content->price}}</h5>
              </div>

              <div class="sec-three">
                <button class="bminus" class="btn-default"  onclick="cartminus({{$content->id}})">
                  <i class="fas fa-minus" ></i>
                </button>
                <input
                  id="bquantity"
                  type="number"
                  class="form-control text-center cart-quantity-input"
                  value="{{$content->quantity}}"
                  min="0"
                />
                <button class="bplus" class="btn-default b-plus"  onclick="cartplus({{$content->id}})">
                  <i class="fas fa-plus" ></i>
                </button>
              </div>

              <div class="sec-four">
                <h5><span class="bamount">{{$content->price*$content->quantity}}</span>&nbspBDT</h5>
              </div>

              <div class="sec-five">
                <i class="fas fa-trash btn-danger delete-button" onclick="deletecart1({{$content->id}})"></i>
              </div>
            </div>
         </div>
           @endforeach



          </div>
       
          <div class="coupon">
            <div class="coupon-sec-one">
              <input type="text" placeholder="code" />
            </div>
            <div class="coupon-sec-two">
              <button>APPLY CODE</button>
            </div>
          </div>

          <div class="sub-total">
            <div class="sub-total-sec-one">
              <h5>Subtotal:</h5>
              <h5>Tax:</h5>
              <h5>Total:</h5>
            </div>
            <div class="sub-total-sec-two">
              <h5><span class="stotal">{{$value}}</span>&nbsp BDT</h5>
              <h5>0 &nbsp &nbsp&nbsp BDT</h5>
              <h5><span class="total">{{$value}}</span>&nbsp BDT</h5>
            </div>
          </div>

          <div class="check-out">
            <a href="{{route('checkout')}}">
              <button type="button" class="btn">
                CHECKOUT
              </button>
            </a>
          </div>
        </div>


    <script type="text/javascript">
        	function deletecart1(id){
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
			       
			      /* $('.drop-sub-total').replaceWith("<div class='drop-sub-total'><div><h5>Total</h5></div><div><h5><span class='drop-total'>"+data.total+"</span>&nbspBDT</h5></div></div>");*/
			      /* var dataObject = data;
			       $.each(dataObject, function(){
			          $('#log').replaceAll("<div><img src='"+this.attributes.image+"' style='width: 100px; height: 100px;'>");
			         });*/
			   }
			});
	
          }

          	function cartminus(id){
	           	$.ajax({
			      url:"{{URL::to('decreasecart')}}",
			      method:"POST",
			      data:{
			        id:id,
			        _token:  "{{ csrf_token() }}"
			      },
			     dataType:"json",
			     success:function(data){
			     console.log(data);
			       
			       $('.item1'+data.id).replaceWith(" <div class='item1"+data.id+"'><div class='cart-item'><div class='sec-one'><img src='"+data.attributes.image+"' style='width: 100px; height: 100px;' alt='' /></div><div class='sec-two'><h5>"+data.name+"</h5></div><div class='unit'><h5>"+data.price+"</h5></div><div class='sec-three'><button class='bminus' class='btn-default'  onclick='cartminus("+data.id+")'><i class='fas fa-minus' ></i></button><input id='bquantity' type='number' class='form-control text-center cart-quantity-input' value="+data.quantity+" min='0' /><button class='bplus' class='btn-default b-plus'  onclick='cartplus("+data.id+")'><i class='fas fa-plus' ></i></button></div><div class='sec-four'><h5><span class='bamount'>"+data.price*data.quantity+"</span>&nbspBDT</h5></div><div class='sec-five'><i class='fas fa-trash btn-danger delete-button' onclick='deletecart1("+data.id+")'></i></div></div></div>");

			        $('.item'+data.id).replaceWith("<div class='item"+data.id+"'><div class='dropdown-content-list-1'><div><img src='"+data.attributes.image+"' style='width: 40px; height: 40px;' alt='' /></div><div><h5><span class='dunit'>"+data.price+"</span>&nbspBDT</h5></div><div><h5>X<span class='dquantity'>"+data.quantity+"</span></h5></div><div><h5><span class='damount'>"+data.price*data.quantity+"</span>&nbspBDT</h5></div><div class='sec-dlt'><i class='fas fa-trash-alt'></i></div></div></div>");
          		   $('.drop-sub-total').replaceWith("<div class='drop-sub-total'><div><h5>Total</h5></div><div><h5><span class='drop-total'>"+data.total+"</span>&nbspBDT</h5></div></div>");

          		   $('.sub-total-sec-two').replaceWith("<div class='sub-total-sec-two'><h5><span class='stotal'>"+data.total+"</span>&nbsp BDT</h5><h5>0 &nbsp &nbsp&nbsp BDT</h5><h5><span class='total'>"+data.total+"</span>&nbsp BDT</h5></div>");



          		     
			      /* var dataObject = data;
			       $.each(dataObject, function(){
			          $('#log').replaceAll("<div><img src='"+this.attributes.image+"' style='width: 100px; height: 100px;'>");
			         });*/
			   }
			});
	
          }
          	function cartplus(id){
	           	$.ajax({
			      url:"{{URL::to('increasecart')}}",
			      method:"POST",
			      data:{
			        id:id,
			        _token:  "{{ csrf_token() }}"
			      },
			     dataType:"json",
			     success:function(data){
			     console.log(data);
			       $('.item1'+data.id).replaceWith(" <div class='item1"+data.id+"'><div class='cart-item'><div class='sec-one'><img src='"+data.attributes.image+"' style='width: 100px; height: 100px;' alt='' /></div><div class='sec-two'><h5>"+data.name+"</h5></div><div class='unit'><h5>"+data.price+"</h5></div><div class='sec-three'><button class='bminus' class='btn-default'  onclick='cartminus("+data.id+")'><i class='fas fa-minus' ></i></button><input id='bquantity' type='number' class='form-control text-center cart-quantity-input' value="+data.quantity+" min='0' /><button class='bplus' class='btn-default b-plus'  onclick='cartplus("+data.id+")'><i class='fas fa-plus' ></i></button></div><div class='sec-four'><h5><span class='bamount'>"+data.price*data.quantity+"</span>&nbspBDT</h5></div><div class='sec-five'><i class='fas fa-trash btn-danger delete-button' onclick='deletecart1("+data.id+")'></i></div></div></div>");

			          $('.item'+data.id).replaceWith("<div class='item"+data.id+"'><div class='dropdown-content-list-1'><div><img src='"+data.attributes.image+"' style='width: 40px; height: 40px;' alt='' /></div><div><h5><span class='dunit'>"+data.price+"</span>&nbspBDT</h5></div><div><h5>X<span class='dquantity'>"+data.quantity+"</span></h5></div><div><h5><span class='damount'>"+data.price*data.quantity+"</span>&nbspBDT</h5></div><div class='sec-dlt'><i class='fas fa-trash-alt'></i></div></div></div>");
           			  $('.drop-sub-total').replaceWith("<div class='drop-sub-total'><div><h5>Total</h5></div><div><h5><span class='drop-total'>"+data.total+"</span>&nbspBDT</h5></div></div>");

           			  $('.sub-total-sec-two').replaceWith("<div class='sub-total-sec-two'><h5><span class='stotal'>"+data.total+"</span>&nbsp BDT</h5><h5>0 &nbsp &nbsp&nbsp BDT</h5><h5><span class='total'>"+data.total+"</span>&nbsp BDT</h5></div>");
			        }
			      });
	
                 }
        </script>


    @endsection