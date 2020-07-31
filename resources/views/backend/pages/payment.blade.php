@extends('layout.backend.master')
@section('contact')
<style type="text/css">
	.modal-header{
		 background: linear-gradient(60deg, #ed6e6b, #f16c69);
	}
	.modal-title{
		color: white;
	      text-align: center;
	}
</style>


 <div class="row">
  <div class="col-12">
    <div class="card m-b-20">
      <div class="card-body">
        <h4 class="mt-0 header-title">Default Datatable</h4>
          <p class="text-muted m-b-30"></p>
            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
             <thead>
               <tr>
                <th>Order Id</th>
        				<th>User Id</th>
        				<th>Payment Method</th>
        				<th>Payment Status</th>
        				<th>Action</th>
              </tr>
            </thead>
    
    
            <tbody id="newlog">
           @foreach($data as $row) 
			 <tr class="item{{$row->id}}">
                <td>{{$row->order_id}}</td>
                <td>{{$row->user_id}}</td>
                <td>{{$row->pay_method}}</td>
                <td>{{$row->pay_status}}</td>
            <td>
        		<button type="button" id="editrecord" class="btn btn-outline-secondary" onclick="editvalue({{$row->id}})" ><i class="fa fa-edit"></i></button>
        		<button type='button' name='delete' id='' class="btn btn-outline-danger" onclick="deletevalue({{$row->id}})"><i class="fa fa-trash" ></i></button>
       			</td>
       			
     		 </tr>
             @endforeach
            </tbody>
            </table>
    
                   </div>
              </div>
         </div> 
     </div>

  <div class="modal fade" id="formModal"  role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning !!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You Can not Input Record  ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


 


<div class="modal fade" id="newModal" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Catagory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	 <span id="resultview"></span>
        <form method="post" id="newform" class="form-horizontal" enctype="multipart/form-data">
          @csrf
           
            <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>Payment method</label>
                 </div>
                 <div class="col-md-6">
                     <select name="pay_method" id="pay_method" class="form-control">
                        <option value="cheque">Cheque</option>
                        <option value="bkash">bKash</option>
                        <option value="paypal">Paypal</option>
                      </select>
                 </div>
             </div>
            </div>

            <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>Paymen Status</label>
                 </div>
                 <div class="col-md-6">
                     <select name="pay_status" id="pay_status" class="form-control">
                        <option value="Pending">Pending</option>
                        <option value="Paid">Paid</option>
                        <option value="Cancel">Paid</option>
                      </select>
                 </div>
             </div>
            </div>


           
           <br />
           <div align="right">
             <input type="hidden" name="actionup" id="actionup" />
              <input type="hidden" name="order_id" id="order_id" class="form-control">
             <input type="hidden" name="user_id" id="user_id" class="form-control">
             <input type="hidden" name="hidden_idup" id="hidden_idup" />
             <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
             <input type="submit" class="btn btn-primary"  name="action_buttonup" id="action_buttonup" value="update"> 
            </div> 
         </form>
      </div>
     
    </div>
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
        Are You Sure Want To Delete ?
      </div>
      <div class="modal-footer">
        <button type="button" name="ok_button" id="ok_button" class="btn btn-outline-primary" data-dismiss="modal" >OK</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
   $(document).ready(function(){


 $('#create_record').click(function(){
     $('#formModal').modal('show');
 });

});

 function editvalue(id){
   $.ajax({
      url:"{{URL::to('editpaymentvalue')}}",
      method:"POST",
      data:{
        id:id,
        _token:  "{{ csrf_token() }}"
      },
     dataType:"json",
     success:function(data){

    console.log(data);
     $('.modal-title').text("Edit Redcord");
     $('#order_id').val(data.order_id);
     $('#user_id').val(data.user_id);
     $('#hidden_idup').val(data.id);
     $('#pay_method').val(data.pay_method);
     $('#pay_status').val(data.pay_status);
     $('#action_buttonup').val("Update");
     $('#actionup').val("Update");
     $('#newModal').modal('show');
     }
        });
$('#newform').on('submit', function(event){
  event.preventDefault();
    if($('#actionup').val() == 'Update')
  {
    $.ajax({
    url:"{{ route('updatepaymentvalue') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     console.log(data);
      if(data.error){
      html = '<div class="alert alert-success">' + data.error + '</div>';
     
      $('#resultview').fadeIn(2000).html(html);
      $('#resultview').fadeOut(2000);
 
    }
    else{
     
         $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.order_id+"</td><td>"+data.user_id+"</td><td>"+data.pay_method+"</td><td>"+data.pay_status+"</td><td><button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");


      if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#newform')[0].reset();
     }
        $('#resultview').fadeIn(2000).html(html);
        $('#resultview').fadeOut(2000);

    }
      }
  });
    
  }

    });
  
} 

function deletevalue(id){
 // console.log(id+email+password+name);
  $('#confirmModal').modal('show');
   $('#ok_button').click(function(){
     $.ajax ({
     type : "POST",
     url : '{{URL::to("/deletepaymentvalue")}}',
     data: {
           id:id,
          _token:  "{{ csrf_token() }}"
           },
     success: function(data){

          console.log(data);
          $('.item'+data.id).remove();
           }   
     });
  })
 }


</script>


@endsection
