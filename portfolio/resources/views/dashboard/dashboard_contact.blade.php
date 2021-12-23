@extends('dashboard.layout.dashboard_app')

@section('title','Contact')

@section('content')
	<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">



<!-- Service Table -->
<table id="ContactDataTable" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>      
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Mobile</th>
	  <th class="th-sm">Email</th>
	  <th class="th-sm">Message</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="Contact_table">

  </tbody>
</table>
</div>
</div>
</div>

<!-- Loder Animation -->
<div id="loderDiv" class="container">
<div class="row">
<div class="col-md-12 p-5 text-center">
	<img class="loading_icon m-5" src="{{asset('dashboard/image/loder.svg')}}" alt="">
</div>
</div>
</div>

<!-- Wrong Text -->
<div id="wrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5 text-center">
	<h3>Something Went Wrong!</h3>
</div>
</div>
</div>


<!--Delete Modal -->
<div class="modal fade" id="ContactDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">      
      <div class="modal-body text-center p-3">
        <h5 class="mt-5">Do You Want To Delete?</h5>        
        <h5 id="ContactDeleteId" class="mt-5 d-none"></h5>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="ContactDeleteConformBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
	<script type="text/javascript">
		getContactData();

		// Get Contact Data
		function getContactData(){
    axios.get('/getContactData')
    .then(function(response){
    	if(response.status==200){
    		$('#mainDiv').removeClass('d-none');
    		$('#loderDiv').addClass('d-none');

    		$('#ContactDataTable').DataTable().destroy();
    		$('#Contact_table').empty();

    		var jsonData=response.data;
          $.each(jsonData,function(i, item){
            $('<tr>').html(            
            "<td>"+jsonData[i].contact_name+"</td>"+ 
            "<td>"+jsonData[i].contact_mobile+"</td>"+            
            "<td>"+jsonData[i].contact_email+"</td>"+            
            "<td>"+jsonData[i].contact_msg+"</td>"+            
            "<td><a class='ContactDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a> </td>"
                ).appendTo('#Contact_table');            
        });

          // Contact Delete Btn Click
          $('.ContactDeleteBtn').click(function(){
          	 var id=$(this).data('id');
          	 $('#ContactDeleteId').html(id);
          	 $('#ContactDelete').modal('show');
          })
          // Contact Table Serch
         $('#ContactDataTable').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');

    	}else{
    		$('#loderDiv').addClass('d-none');
    		$('#wrongDiv').removeClass('d-none');
    	}  

    }).catch(function(error){
    	$('#loderDiv').addClass('d-none');
    	$('#wrongDiv').removeClass('d-none');
    })
}

	// Contact Delete Yes Btn Click
	$('#ContactDeleteConformBtn').click(function(){
		var id=$('#ContactDeleteId').html();
		ContactDelete(id);
	})

	// Contact Delelte
	function ContactDelete(deleteID){
		axios.post('/ContactDelete',{id:deleteID})
		.then(function(response){
			if(response.status==200 && response.data==1){
			$('#ContactDelete').modal('hide');
            toastr.success('Delete Success');
            getContactData();

			}else{
			$('#ContactDelete').modal('hide');
            toastr.error('Delete Fail');
            getContactData();
			}

		}).catch(function(error){
			$('#ContactDelete').modal('hide');
            toastr.error('Delete Fail');
		})
	}
	</script>
@endsection