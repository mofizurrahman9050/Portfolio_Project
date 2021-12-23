 @extends('dashboard.layout.dashboard_app') 
@section('title','Project')
 @section('content')
<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

    <button id="ProjectAddNew" class="btn btn-sm btn-primary mb-3">Add New</button>

 <!-- Project Table   --> 
<table id="ProjectdataTable" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
      <th class="th-sm">Name</th>
      <th class="th-sm">Description</th>
      <th class="th-sm">ProjectLink</th>
      <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="project_table">

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

<!-- Wrong section -->
<div id="wrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5 text-center"> 
    <h3>Something Went Wrong!</h3>
</div>
</div>
</div>


<!--Project Delete Modal -->
<div class="modal fade" id="ProjectDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     
      <div class="modal-body text-center p-3">
        <h4 class="mt-5">Do You Want To Delete?</h4>
        <h4 id="ProjectDeleteId" class="mt-5 d-none"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="ProjectDeleteConformBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!--Project Edite Modal -->
<div class="modal fade" id="ProjectEdite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     
      <div class="modal-body text-center p-3">        
        <h4 id="ProjectEditeId" class="mt-5 d-none"></h4>

        <h5 class="mb-3">Project Edite Form</h5>
        <div id="ProjectEditeForm" class="w-100 d-none">
        <input id="ProjectNameID" type="text" id="" class="form-control mb-4" placeholder="Service Name">
        <input id="ProjectDesID" type="text" id="" class="form-control mb-4" placeholder="Service Des">
        <input id="ProjectLinkID" type="text" id="" class="form-control mb-4" placeholder="Service Link">
        <input id="ProjectImgID" type="text" id="" class="form-control mb-4" placeholder="Service Img">
        </div>

        <img id="ProjectEditeloder" class="loading_icon m-5" src="{{asset('dashboard/image/loder.svg')}}" alt="">
        <h5 id="ProjectWrongDiv" class="d-none">Something Went Wrong!</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="ProjectEditeConformBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!--Project Add Modal -->
<div class="modal fade" id="ProjectAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     
      <div class="modal-body text-center p-3">      
        <h5 class="my-4">Project Add New</h5>

        <div id="ProjectAddForm" class="w-100">
        <input id="ProjectNameAddID" type="text" id="" class="form-control mb-4" placeholder="Service Name">
        <input id="ProjectDesAddID" type="text" id="" class="form-control mb-4" placeholder="Service Des">
        <input id="ProjectLinkAddID" type="text" id="" class="form-control mb-4" placeholder="Service Link">
        <input id="ProjectImgAddID" type="text" id="" class="form-control mb-4" placeholder="Service Img">
        </div>   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="ProjectAddConformBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        getProjetData();

        // Get Project Data
function getProjetData(){
    axios.get('/getProjectData')
    .then(function(response){

        if(response.status==200){

            $('#mainDiv').removeClass('d-none');
            $('#loderDiv').addClass('d-none');

            $('#ProjectdataTable').DataTable().destroy();
            $('#project_table').empty();

              var jsonData= response.data;
        $.each(jsonData,function(i, item){
            $('<tr>').html(
                "<td><img class='table-img' src="+jsonData[i].project_name+"></td>"+
                "<td>"+jsonData[i].project_name +"</td>"+
                "<td>"+jsonData[i].project_des+"</td>"+
                "<td>"+jsonData[i].project_link+"</td>"+
                "<td><a class='ProjectEditeBtn' data-id="+jsonData[i].id+" ><i class='fas fa-edit'></i></a></td>"+
                "<td><a class='ProjectDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#project_table');
        });
            // Project Delete Icon Click
            $('.ProjectDeleteBtn').click(function(){
                var id= $(this).data('id');
                $('#ProjectDeleteId').html(id);
                $('#ProjectDelete').modal('show');
            })

            // Project Edite Icon Click
            $('.ProjectEditeBtn').click(function(){
                var id= $(this).data('id');
                $('#ProjectEditeId').html(id);
                getProjectDetails(id);
                $('#ProjectEdite').modal('show');
            })

            // Project DataTable 
            $('#ProjectdataTable').DataTable({"order":false});
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

// Project Delete Success
 $('#ProjectDeleteConformBtn').click(function(){
                var id= $('#ProjectDeleteId').html();
                ProjetDelete(id);
            })

// Project Delete
function ProjetDelete(deleteID){
    $('#ProjectDeleteConformBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //Animation
    axios.post('/ProjectDelete',{id:deleteID})
    .then(function(response){
        $('#ProjectDeleteConformBtn').html("Yes");
        if(response.status==200){
            if(response.data==1){
            $('#ProjectDelete').modal('hide');
            toastr.success('Delete Success');
            getProjetData();
        }else{
            $('#ProjectDelete').modal('hide');
            toastr.error('Delete Fail');
            getProjetData();
        }
        }else{
           $('#ProjectDelete').modal('hide');
            toastr.error('Something Went Wrong!'); 
        }      
    }).catch(function(error){
        $('#ProjectDelete').modal('hide');
            toastr.error('Something Went Wrong!'); 
    });
}

// Project Edite details
function getProjectDetails(datailsID){
    axios.post('/ProjectDetails', {id:datailsID})
    .then(function(response){

        if(response.status==200){
            $('#ProjectEditeForm').removeClass('d-none');
            $('#ProjectEditeloder').addClass('d-none');

            var jsonData=response.data;
            $('#ProjectNameID').val(jsonData[0].project_name);
            $('#ProjectDesID').val(jsonData[0].project_des);
            $('#ProjectLinkID').val(jsonData[0].project_link);
            $('#ProjectImgID').val(jsonData[0].project_img);
        }
        else{
            $('#ProjectEditeloder').addClass('d-none');
            $('#ProjectWrongDiv').removeClass('d-none');
        }
    }).catch(function(error){
        $('#ProjectEditeloder').addClass('d-none');
            $('#ProjectWrongDiv').removeClass('d-none');
    })
} 

// Project Update Conform Btn
$('#ProjectEditeConformBtn').click(function(){
   var id= $('#ProjectEditeId').html();
   var name= $('#ProjectNameID').val();
   var des= $('#ProjectDesID').val();
   var link= $('#ProjectLinkID').val();
   var img= $('#ProjectImgID').val();
   ProjectUpdate(id,name,des,link,img);

})

// Project Update
function ProjectUpdate(updateID,updateName,updateDes,updatelink,updateImg){    
    if(updateName.length==0){
        toastr.error('Project Name is Empty!');
    }else if(updateDes.length==0){
        toastr.error('Project Description is Empty!');
    }else if(updatelink.length==0){
        toastr.error('Project link is Empty!');
    }else if(updateImg.length==0){
        toastr.error('Project Image is Empty!');
    }else{
        $('#ProjectEditeConformBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //Animation
        axios.post('/ProjectUpdate', {
        id:updateID,
        name:updateName,
        des:updateDes,
        link:updatelink,
        img:updateImg
    })
    .then(function(response){
        $('#ProjectEditeConformBtn').html("Save");
        if(response.status==200){
            if(response.data==1){
            $('#ProjectEdite').modal('hide');
            toastr.success('Update Success');
            getProjetData();
        }else{
             $('#ProjectEdite').modal('hide');
            toastr.error('Update Fail');
            getProjetData();
        }
        }else{
             $('#ProjectEdite').modal('hide');
            toastr.error('Something Went Wrong');
        }

    }).catch(function(error){
        $('#ProjectEdite').modal('hide');
            toastr.error('Something Went Wrong'); 
    })  
    }
}

// Project AddNew Btn Click
$('#ProjectAddNew').click(function(){
    $('#ProjectAdd').modal('show');
})

// Project Add Conform Btn Click
$('#ProjectAddConformBtn').click(function(){
    var name=$('#ProjectNameAddID').val();
    var des=$('#ProjectDesAddID').val();
    var link=$('#ProjectLinkAddID').val();
    var img=$('#ProjectImgAddID').val();
    ProjectAddNew(name,des,link,img);
})

// Project Add
function ProjectAddNew(addName,addDes,addlink,addImg){    
    if(addName.length==0){
        toastr.error('Project Name is Empty!');
    }else if(addDes.length==0){
        toastr.error('Project Description is Empty!');
    }else if(addlink.length==0){
        toastr.error('Project link is Empty!');
    }else if(addImg.length==0){
        toastr.error('Project Image is Empty!');
    }else{
        $('#ProjectAddConformBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //Animation
        axios.post('/ProjectAdd', {        
        name:addName,
        des:addDes,
        link:addlink,
        img:addImg
    })
    .then(function(response){
        $('#ProjectAddConformBtn').html("Save");
        if(response.status==200){
            if(response.data==1){
            $('#ProjectAdd').modal('hide');
            toastr.success('Add Success');
            getProjetData();
        }else{
             $('#ProjectAdd').modal('hide');
            toastr.error('Add Fail');
            getProjetData();
        }
        }else{
             $('#ProjectAdd').modal('hide');
            toastr.error('Something Went Wrong');
        }

    }).catch(function(error){
        $('#ProjectAdd').modal('hide');
            toastr.error('Something Went Wrong'); 
    })  
    }
}
    </script>
@endsection

  