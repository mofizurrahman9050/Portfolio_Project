@extends('dashboard.layout.dashboard_app')
@section('title','Service')

@section('content')
<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

 <!-- Add New Btn    -->
<button id="AddNewId" class="btn my-3 btn-sm btn-primary">Add New</button>

<!-- Service Table -->
<table id="ServiceDataTable" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">

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
<div class="modal fade" id="ServiceDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">      
      <div class="modal-body text-center p-3">
        <h5 class="mt-5">Do You Want To Delete?</h5>        
        <h5 id="ServiceDeleteId" class="mt-5 d-none"></h5>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="ServiceDeleteConformBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!--Edite Modal -->
<div class="modal fade" id="ServiceEdite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">      
      <div class="modal-body text-center p-3">                
        <h5 id="ServiceEditeId" class="mt-5 d-none"></h5>

        <h5 class="mb-3">Service Edite Form</h5>
        <div id="ServiceEditeForm" class="w-100 d-none">
        <input id="ServiceNameID" type="text" id="" class="form-control mb-4" placeholder="Service Name">
        <input id="ServiceDesID" type="text" id="" class="form-control mb-4" placeholder="Service Description">
        <input id="ServiceImgID" type="text" id="" class="form-control mb-4" placeholder="Service Image Link">
        </div>

        <img id="EditeloderDiv" class="loading_icon m-5" src="{{asset('dashboard/image/loder.svg')}}" alt="">
        <h5 id="ServiceEditeWrong" class="d-none">Something Went Wrong!</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
        <button id="ServiceEditeConformBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!--Add Modal -->
<div class="modal fade" id="ServiceAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">      
      <div class="modal-body text-center p-3">                
        
        <h5 class="mb-3">Service Add New</h5>
        <div id="ServiceAddForm" class="w-100">
        <input id="ServiceNameAddID" type="text" id="" class="form-control mb-4" placeholder="Service Name">
        <input id="ServiceDesAddID" type="text" id="" class="form-control mb-4" placeholder="Service Description">
        <input id="ServiceImgAddID" type="text" id="" class="form-control mb-4" placeholder="Service Image Link">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
        <button id="ServiceAddConformBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection



@section('script')
	<script type="text/javascript">
		getServicesData();

    
// Get service Data
function getServicesData(){
    axios.get('/getServicesData')
    .then(function(response){

        if(response.status==200){
            $('#mainDiv').removeClass('d-none');
            $('#loderDiv').addClass('d-none');

            $('#ServiceDataTable').DataTable().destroy();
            $('#service_table').empty();

              var jsonData= response.data;
        $.each(jsonData,function(i, item){
            $('<tr>').html(
            "<td><img class='table-img' src="+jsonData[i].service_img+"></td>"+ 
            "<td>"+jsonData[i].service_name+"</td>"+ 
            "<td>"+jsonData[i].service_des+"</td>"+             
            "<td><a class='ServiceEditeBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a> </td>"+ 
            "<td><a class='ServiceDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a> </td>"
                ).appendTo('#service_table');
        });

        // Service Delete Icon Click
        $('.ServiceDeleteBtn').click(function(){
              var  id= $(this).data('id');
              $('#ServiceDeleteId').html(id);
              $('#ServiceDelete').modal('show');
        })

        // service Edite Icon Click
        $('.ServiceEditeBtn').click(function(){
            var id= $(this).data('id');
            $('#ServiceEditeId').html(id);
            ServiceUpdateDetails(id);
            $('#ServiceEdite').modal('show');
        }) 

        // Service Table Search
        $('#ServiceDataTable').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');       

        }else{
            $('#loderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        }
      
    }).catch(function (error) {
         $('#loderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
});
}

// Service Delete Modal yes Success
$('#ServiceDeleteConformBtn').click(function(){
            var  id= $('#ServiceDeleteId').html();
            ServiceDelete(id);
        })

// Service Delete
function ServiceDelete(deleteID){
    $('#ServiceDeleteConformBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //Animation
    axios.post('/ServicesDelete', {id:deleteID})
    .then(function(response){      
        $('#ServiceDeleteConformBtn').html("Yes");
        if(response.status==200){
            if(response.data==1){
            $('#ServiceDelete').modal('hide');
            toastr.success('Delete Success');
            getServicesData();
        }else{
            $('#ServiceDelete').modal('hide');
            toastr.error('Delete Fail');
            getServicesData();
        }
        }else{
            $('#ServiceDelete').modal('hide');
            toastr.error('Something Went Wrong!');
        }    
    }).catch(function(error){
       $('#ServiceDelete').modal('hide');
        toastr.error('Something Went Wrong!');  
    });
}

// Service Details
function ServiceUpdateDetails(detailsID){
    axios.post('/ServicesDetails',{id:detailsID})
    .then(function(response){

        if(response.status==200){
            $('#ServiceEditeForm').removeClass('d-none');
            $('#EditeloderDiv').addClass('d-none');

            var jsonData=response.data;
            $('#ServiceNameID').val(jsonData[0].service_name);
            $('#ServiceDesID').val(jsonData[0].service_des);
            $('#ServiceImgID').val(jsonData[0].service_img);
        }
        else{
            $('#EditeloderDiv').addClass('d-none');
            $('#ServiceEditeWrong').removeClass('d-none');
        }

    }).catch(function(error){
        $('#EditeloderDiv').addClass('d-none');
        $('#ServiceEditeWrong').removeClass('d-none');
    })
}

// Service Update
$('#ServiceEditeConformBtn').click(function(){
   var id= $('#ServiceEditeId').html();
   var name= $('#ServiceNameID').val();
   var des= $('#ServiceDesID').val();
   var img= $('#ServiceImgID').val();
   ServicesUpdate(id,name,des,img);
})

// Service Update 
function ServicesUpdate(updateID,updateName,updateDes,updateImg){    
    if(updateName.length==0){
        toastr.error('Service Name is Empty !');
    }else if(updateDes.length==0){
        toastr.error('Service Description is Empty !');
    }else if(updateImg.length==0){
        toastr.error('Service Image is Empty !');
    }else{
    $('#ServiceEditeConformBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //Animation
        axios.post('/ServicesUpdate',{
        id:updateID,
        name:updateName,
        des:updateDes,
        img:updateImg,
    })
    .then(function(response){
        $('#ServiceEditeConformBtn').html("Save");
        if(response.status==200){
             if(response.data==1){
            $('#ServiceEdite').modal('hide');
            toastr.success('Update Success');
            getServicesData();
        }else{
            $('#ServiceEdite').modal('hide');
            toastr.error('Update Fail');
            getServicesData();
        }
        }else{
            $('#ServiceEdite').modal('hide');
            toastr.error('Someting Went Wrong!');
        }       
    }).catch(function(error){
        $('#ServiceEdite').modal('hide');
        toastr.error('Someting Went Wrong!');  
    })
    } 
}

// Service AddNew Btn Click 
$('#AddNewId').click(function(){
    $('#ServiceAdd').modal('show');
})

// Service Add
$('#ServiceAddConformBtn').click(function(){  
   var name= $('#ServiceNameAddID').val();
   var des= $('#ServiceDesAddID').val();
   var img= $('#ServiceImgAddID').val();
   ServicesAdd(name,des,img);
})


// Service Add 
function ServicesAdd(addName,addDes,addImg){    
    if(addName.length==0){
        toastr.error('Service Name is Empty !');
    }else if(addDes.length==0){
        toastr.error('Service Description is Empty !');
    }else if(addImg.length==0){
        toastr.error('Service Image is Empty !');
    }else{
    $('#ServiceAddConformBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //Animation
        axios.post('/ServicesAdd',{       
        name:addName,
        des:addDes,
        img:addImg,
    })
    .then(function(response){
        $('#ServiceAddConformBtn').html("Save");
        if(response.status==200){
             if(response.data==1){
            $('#ServiceAdd').modal('hide');
            toastr.success('Add Success');
            getServicesData();
        }else{
            $('#ServiceAdd').modal('hide');
            toastr.error('Add Fail');
            getServicesData();
        }
        }else{
            $('#ServiceAdd').modal('hide');
            toastr.error('Someting Went Wrong!');
        }       
    }).catch(function(error){
        $('#ServiceAdd').modal('hide');
        toastr.error('Someting Went Wrong!');  
    })
    } 
}
	</script>
@endsection