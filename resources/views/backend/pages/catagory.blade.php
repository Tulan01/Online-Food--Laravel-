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
                <th>Catagory Name</th>
				        <th>Status</th>
				        <th>Action</th>
              </tr>
            </thead>
    
    
            <tbody id="newlog">
           @foreach($data as $row) 
			 <tr class="item{{$row->id}}">
                <td>{{$row->catagory_name}}</td>
				<?php if($row->catagory_status=='Active') {?>
	            <td><span class="label label-success">Active</span></td>
				<?php } else { ?>
				<td><span class="label label-danger">Inactive</span></td>
				<?php } ?>
				<td>
				<button type='button' name='delete' id='' class="btn btn-outline-secondary" onclick="changestatusvalue({{$row->id}})"><i class="fas fa-refresh" ></i></button>
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

    <div class="modal fade" id="formModal" role="dialog" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Catagory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	 <span id="form_result"></span>
        <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
           <div class="form-group">
           <div class="row">
           	     <div class="col-md-3">
                    <label>Catagory</label>
                 </div>
                
              	 <div class="col-md-6">
                      <input type="text" name="catagory_name" id="catagory_name" class="form-control">
                 </div>
             </div>
            </div>
            <div class="form-group">
           <div class="row">
           	     <div class="col-md-3">
                    <label>Status</label>
                 </div>
                
              	 <div class="col-md-6">
                     <select name="catagory_status" id="catagory_status" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                 </div>
             </div>
            </div>
        
           <br />
           <div align="right">
             <input type="hidden" name="action" id="action" />
             <input type="hidden" name="hidden_id" id="hidden_id" />
             <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
             <input type="submit" class="btn btn-primary"  name="action_button" id="action_button" value="add">  
           </div>
         </form>
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
                    <label>Catagory</label>
                 </div>
                
              	 <div class="col-md-6">
                      <input type="text" name="catagory_nameup" id="catagory_nameup" class="form-control">
                 </div>
             </div>
            </div>
            <div class="form-group">
           <div class="row">
           	     <div class="col-md-3">
                    <label>Status</label>
                 </div>
                
              	 <div class="col-md-6">
                     <select name="catagory_statusup" id="catagory_statusup" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                 </div>
             </div>
            </div>
           
           <br />
           <div align="right">
             <input type="hidden" name="actionup" id="actionup" />
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
  $('.modal-title').text("Add New Record");
     $('#action_button').val("Add");
     $('#action').val("Add");
     $('#formModal').modal('show');
 });



 $('#sample_form').on('submit', function(event){
  event.preventDefault();

  if($('#action').val() == 'Add')
  {
   $.ajax({
    url:"{{route('addcatagory')}}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    { 

        if(data.error){
      html = '<div class="alert alert-success">' + data.error + '</div>';
     
      $('#form_result').fadeIn(2000).html(html);
      $('#form_result').fadeOut(2000);
 
    }
    else{
     if(data.catagory_status=='Active'){
          $('#newlog').append("<tr class='item"+data.id+"'><td>"+data.catagory_name+"</td><td><span class='label label-success'>Active</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
        
      }
      else{
           $('#newlog').append("<tr class='item"+data.id+"'><td>"+data.catagory_name+"</td><td><span class='label label-success'>Inactive</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
         }
      console.log(data);
    if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#sample_form')[0].reset();
     }
        $('#form_result').fadeIn(2000).html(html);
        $('#form_result').fadeOut(2000);
   }
 }
  });
 }
});

});

 function editvalue(id){
   $.ajax({
      url:"{{URL::to('editcatagoryvalue')}}",
      method:"POST",
      data:{
        id:id,
        _token:  "{{ csrf_token() }}"
      },
     dataType:"json",
     success:function(data){

    console.log(data);
     $('.modal-title').text("Edit Redcord");
     $('#catagory_nameup').val(data.catagory_name);
     $('#catagory_statusup').val(data.catagory_status);
     $('#hidden_idup').val(data.id);
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
    url:"{{ route('updatecatagoryvalue') }}",
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
    
        if(data.catagory_status=='Active'){
         $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.catagory_name+"</td><td><span class='label label-success'>Active</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
       } else{
         $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.catagory_name+"</td><td><span class='label label-success'>Inactive</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
       }

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
     url : '{{URL::to("/deletecatagoryvalue")}}',
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


 function changestatusvalue(id){
 // console.log(id+email+password+name);
     $.ajax ({
     type : "POST",
     url : '{{URL::to("/changecatagoryvalue")}}',
     data: {
           id:id,
          _token:  "{{ csrf_token() }}"
           },
     success: function(data){

              console.log(data);
    if(data.catagory_status=='Active'){
      $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.catagory_name+"</td><td><span class='label label-success'>Active</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
       } else{
         $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.catagory_name+"</td><td><span class='label label-success'>Inactive</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
       }
        
  
           }   
     });
 }
</script>




@endsection