@extends('layout.frontend.master')
@section('contact')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"> 
 <div class="delivery">
          <div class="billing-address">
            <h2>Billing Address</h2>
            <form action="{{route('savecheckout')}}" method="POST">
              @csrf
            <div class="address">
              <h5>Address</h5>
              <input
                type="text"
                placeholder="Enter your street address.."
                name="add"
                id=""
              />
              <input
                type="text"
                placeholder="Enter the apartment,floor,suite etc"
                name="add2"
                id=""
              />
            </div>
            <div class="town">
              <h5>Town/City*</h5>
              <input
                type="text"
                placeholder="Enter your street address.."
                name="city"
                id=""
              />
            </div>
            <div class="country-post">
              <div class="country">
                <h5>Country*</h5>
                <input
                  type="text"
                  placeholder="Enter your country.."
                  name="country"
                  id=""
                />
              </div>
              <div class="post">
                <h5>Post Code*</h5>
                <input
                  type="text"
                  placeholder="Enter your post code.."
                  name="post_code"
                  id=""
                />
              </div>
            </div>
                <div class="payment-method">
            <h2>Payment Method</h2>
            <div>
              
              <input type="radio" id="cash" name="payment" value="cheque"  />
              <label for="cash">Cash in Delivery</label><br />
              <input id="cash-input" type="text" style="display: none;" /><br />

              <input type="radio" id="paypal" name="payment" value="paypal"  />
              <label for="paypal">Paypal</label><br />
              <input id="paypal-input" type="text" style="display: none;" /><br />

              <input type="radio" id="bkash" name="payment" value="bkash" />
              <label for="bkash">Bkash</label>
              <input id="bkash-input" type="text" style="display: none;" /><br />
            </div>

            <div>
              <button type="submit">
                  Place Order
              </button>
            </div>
          </div>
        </form>
          </div>

          <div class="your-order">
            <h2>Your Order</h2>
            <table>
              <tr>
                <th>PRODUCTS NAME</th>
                <th>QTY</th>
                <th>SUBTOTAL</th>
              </tr>
              @foreach($contents as $content)
              <tr class="item{{$content->id}}">
                <td>{{$content->name}}</td>
                <td>{{$content->quantity}}</td>
                <td>{{$content->price*$content->quantity}} BDT</td>
              </tr>
             @endforeach
            
            </table>
            <hr />
            <div class="total">
              <div class="left">
                <h4>Cart Subtotal</h4>
                <h4>Tax</h4>
                <h4>Order Total</h4>
              </div>
              <div class="right">
                <h4>{{$value}} BDT</h4>
                <h4>0 BDT</h4>
                <h4>{{$value}} BDT</h4>
              </div>
            </div>
          </div>

        </div>


  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
  @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"

    switch(type){
      case 'info':
             toastr.info("{{ Session::get('message') }}");
             break;
          case 'success':
              toastr.success("{{ Session::get('message') }}");
              break;
          case 'warning':
              toastr.warning("{{ Session::get('message') }}");
              break;
          case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif

  console.log(type);
</script>


@endsection