
@extends('layout.frontend.master2')
@section('contact')

<div class="order">
        <div id="menu-off" class="wrapper" style="display: block;">
          <div class="head-bar">
            <div class="container1">
              <div class="logo"></div>
              <div class="menu">
                <ul>
                  <li>
                    <a data-filter=".all" href="#" class="active">All</a>
                  </li>
                  @foreach($catagory as $catagory)
                  <li>
                    <a data-filter=".{{$catagory->id}}" href="#">{{$catagory->catagory_name}}</a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="content">
          <div class="container1">
            @foreach($item as $item)

            <figure class="card {{$item->catagory_id}} all">
              <img src="{{URL::to($item->item_image)}}" style="height: 195px; width: 270px;" alt="" />
              <figcaption>
                <h3>{{$item->item_name}}</h3>
                <p>
                  {!! html_entity_decode($item->item_details) !!}
                </p>
              </figcaption>
              <div class="item-icon">
                  <button onclick="addtocart({{$item->id}})" class="cart">Add to Cart</button>
              </div>
            </figure>

            @endforeach

        


         


          </div>
        </div>
      </div>
     <script type="text/javascript">
function addtocart(id){
  //console.log(id);
  $.ajax({
      url:"{{URL::to('addcart')}}",
      method:"POST",
      data:{
        id:id,
        _token:  "{{ csrf_token() }}"
      },
     dataType:"json",
     success:function(data){
     console.log(data);
     if(data.duplecate){
        $('#log').append("<div class='item"+data.id+"'><div class='dropdown-content-list-1'><div><img src='"+data.attributes.image+"' style='width: 40px; height: 40px;' alt='' /></div><div><h5><span class='dunit'>"+data.price+"</span>&nbspBDT</h5></div><div><h5>X<span class='dquantity'>"+data.quantity+"</span></h5></div><div><h5><span class='damount'>"+data.price*data.quantity+"</span>&nbspBDT</h5></div><div class='sec-dlt'><i class='fas fa-trash-alt' onclick='deletecart("+data.id+")'></i></div></div></div>");

        $('.drop-sub-total').replaceWith("<div class='drop-sub-total'><div><h5>Total</h5></div><div><h5><span class='drop-total'>"+data.total+"</span>&nbspBDT</h5></div></div>");
         $('#notific').html(data.noti);
              
        }else{
           $('.item'+data.id).replaceWith("<div class='item"+data.id+"'><div class='dropdown-content-list-1'><div><img src='"+data.attributes.image+"' style='width: 40px; height: 40px;' alt='' /></div><div><h5><span class='dunit'>"+data.price+"</span>&nbspBDT</h5></div><div><h5>X<span class='dquantity'>"+data.quantity+"</span></h5></div><div><h5><span class='damount'>"+data.price*data.quantity+"</span>&nbspBDT</h5></div><div class='sec-dlt'><i class='fas fa-trash-alt'  onclick='deletecart("+data.id+")'></i></div></div></div>");
           $('.drop-sub-total').replaceWith("<div class='drop-sub-total'><div><h5>Total</h5></div><div><h5><span class='drop-total'>"+data.total+"</span>&nbspBDT</h5></div></div>");
            $('#notific').html(data.noti);
        }
      /* var dataObject = data;
       $.each(dataObject, function(){
          $('#log').replaceAll("<div><img src='"+this.attributes.image+"' style='width: 100px; height: 100px;'>");
         });*/
   }
});
}
</script>


@endsection