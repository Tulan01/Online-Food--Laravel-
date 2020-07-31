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
               <th>Days Name</th>
               <th>Status</th>
               <th>Action</th>
              </tr>
            </thead>
    
    
            <tbody id="newlog">
           @foreach($data as $row) 
			<tr class="item{{$row->id}}">
       			<td>{{$row->days_name}}</td>
        		<?php if($row->days_status=='Active') {?>
        		<td><span class="label label-success">Active</span></td>
         		<?php } else { ?>
       		    <td><span class="label label-danger">Inactive</span></td>
            	<?php } ?>
          		<td>
        		<button type='button' name='delete' id='' class="btn btn-outline-secondary" onclick="changestatusvalue({{$row->id}})"><i class="fa fa-refresh" ></i></button>
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

<!-- Modal -->
<div class="modal fade" id="formModal" role="dialog" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Days</h5>
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
                    <label>Days</label>
                 </div>
                
              	 <div class="col-md-6">
                      <input type="text" name="days_name" id="days_name" class="form-control">
                 </div>
             </div>
            </div>
             <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>Short Name</label>
                 </div>
                
                 <div class="col-md-6">
                      <input type="text" name="days_name_short" id="days_name_short" class="form-control">
                 </div>
             </div>
            </div>
           
            <div class="form-group">
           <div class="row">
           	     <div class="col-md-3">
                    <label>Status</label>
                 </div>
                
              	 <div class="col-md-6">
                     <select name="days_status" id="days_status" class="form-control">
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


<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <label>Days</label>
                 </div>
                
                 <div class="col-md-6">
                      <input type="text" name="days_nameup" id="days_nameup" class="form-control">
                 </div>
             </div>
            </div>
            <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>Short Name</label>
                 </div>
                
                 <div class="col-md-6">
                      <input type="text" name="days_name_shortup" id="days_name_shortup" class="form-control">
                 </div>
             </div>
            </div>
           
       
            <div class="form-group">
           <div class="row">
                 <div class="col-md-3">
                    <label>Status</label>
                 </div>
                
                 <div class="col-md-6">
                     <select name="days_statusup" id="days_statusup" class="form-control">
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
        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger" data-dismiss="modal" >OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js
"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js
"></script>


<script type="text/javascript">
    $(document).ready(function() {
    $('#infolog_table').DataTable();  
} );
</script>


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
    url:"{{route('adddays')}}",
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
       if(data.days_status=='Active'){
          $('#newlog').append("<tr class='item"+data.id+"'><td>"+data.days_name+"</td><td><span class='label label-success'>Active</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
        
      }
      else{
           $('#newlog').append("<tr class='item"+data.id+"'><td>"+data.days_name+"</td><td><span class='label label-success'>Inactive</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
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
      url:"{{URL::to('editdaysvalue')}}",
      method:"POST",
      data:{
        id:id,
        _token:  "{{ csrf_token() }}"
      },
     dataType:"json",
     success:function(data){

    console.log(data);
     $('.modal-title').text("Edit Redcord");
     $('#days_nameup').val(data.days_name);
     $('#days_statusup').val(data.days_status);
     $('#days_name_shortup').val(data.days_name_short);
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
    url:"{{ route('updatedaysvalue') }}",
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
    
        if(data.days_status=='Active'){
         $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.days_name+"</td><td><span class='label label-success'>Active</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
       } else{
         $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.days_name+"</td><td><span class='label label-success'>Inactive</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
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
     url : '{{URL::to("/deletedaysvalue")}}',
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
     url : '{{URL::to("/changedaysvalue")}}',
     data: {
           id:id,
          _token:  "{{ csrf_token() }}"
           },
     success: function(data){

              console.log(data);
    if(data.days_status=='Active'){
      $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.days_name+"</td><td><span class='label label-success'>Active</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
       } else{
         $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.days_name+"</td><td><span class='label label-success'>Inactive</span></td><td><button type='button' id='changestatus' class='btn btn-outline-secondary' onclick='changestatusvalue("+data.id+")'><i class='fa fa-refresh'></i></button> <button type='button' id='editrecord' class='btn btn-outline-secondary' onclick='editvalue("+data.id+")'><i class='fa fa-edit'></i></button> <button type='button' name='delete' id='' class='btn btn-outline-danger' onclick='deletevalue("+data.id+")'><i class='fa fa-trash'></i></button></td></tr>");
       }
        
  
           }   
     });
 }
</script>

@endsection
