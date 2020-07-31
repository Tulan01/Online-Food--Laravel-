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
        				<th>Flat</th>
        				<th>Area </th>
                <th>City</th>
        				<th>Country</th>
                <th>Post Code</th>
        				<th>Action</th>
              </tr>
            </thead>
    
    
            <tbody id="newlog">
           @foreach($data as $row) 
			 <tr class="item{{$row->id}}">
                <td>{{$row->order_id}}</td>
                <td>{{$row->user_id}}</td>
                <td>{{$row->add2}}</td>
                <td>{{$row->add}}</td>
                <td>{{$row->city}}</td>
                <td>{{$row->country}}</td>
                <td>{{$row->post_code}}</td>
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
        You Can not Input New Address  ?
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
                    <label>Flat</label>
                 </div>
                
                 <div class="col-md-6">
                      <input type="text" name="add2" id="add2" class="form-control">
                 </div>
             </div>
            </div>
             <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>Area</label>
                 </div>
                
                 <div class="col-md-6">
                      <input type="text" name="add" id="add" class="form-control">
                 </div>
             </div>
            </div>
             <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>City</label>
                 </div>
                
                 <div class="col-md-6">
                      <input type="text" name="city" id="city" class="form-control">
                 </div>
             </div>
            </div>
             <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>Country</label>
                 </div>
                
                 <div class="col-md-6">
                      <input type="text" name="country" id="country" class="form-control">
                 </div>
             </div>
            </div>
             <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>Post Code</label>
                 </div>
                
                 <div class="col-md-6">
                      <input type="text" name="post_code" id="post_code" class="form-control">
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
      url:"{{URL::to('editaddressvalue')}}",
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
     $('#add2').val(data.add2);
     $('#add').val(data.add);
     $('#city').val(data.city);
     $('#country').val(data.country);
     $('#post_code').val(data.post_code);
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
    url:"{{ route('updateaddressvalue') }}",
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
    
         $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.order_id+"</td><td>"+data.user_id+"</td><td>"+data.add2+"</td><td>"+data.add+"</td><td>"+data.city+"</td><td>"+data.country+"</td><td>"+data.post_code+"</td><td><button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");


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
     url : '{{URL::to("/deleteaddressvalue")}}',
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
