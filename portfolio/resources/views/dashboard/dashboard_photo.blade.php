@extends('dashboard.layout.dashboard_app')
@section('title','Photo Gallery')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<button id="PhotoAddnewBtn" class="btn btn-sm btn-primary mt-5">Add New</button>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row PhotoRow">
		</div>
		<button id="loadMoreBtn" class="btn btn-sm btn-primary">Load More</button>
	</div>


	<!--Photo Gallery Modal -->
<div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     
      <div class="modal-body text-center p-3">
      	<h5 class="mb-3">Add New Photo</h5>
        	<input id="ImgInput" class="form-control" type="file">
        	<img id="ImgPreview" class="ImgPreview mt-3" src="{{asset('/dashboard/image/default.jpg')}}" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancle</button>
        <button id="PhotoSave" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')
	<script type="text/javascript">

		// Photo Add New Btn Show
		$('#PhotoAddnewBtn').click(function(){
			$('#PhotoModal').modal('show');
		})

		// Img Input Reader
		 $('#ImgInput').change(function(){
		 	var reader=new FileReader();
		 	reader.readAsDataURL(this.files[0]);

		 	reader.onload=function(event){
		 	var ImgSourse= event.target.result;
		 	$('#ImgPreview').attr('src',ImgSourse);
		 	}
		})

		 // Photo save Conform
		 $('#PhotoSave').click(function(){
		 	$('#PhotoSave').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //Animation
		 	var PhotoFile= $('#ImgInput').prop('files')[0];
		 	var formData=new FormData();
		 	formData.append('photo',PhotoFile);

		 	axios.post('/PhotoUpload',formData)
		 	.then(function(response){
		 		if(response.status==200 && response.data==1){
		 			$('#PhotoModal').modal('hide');
		 			$('#PhotoSave').html('save');
		 			toastr.success('Photo Upload Sussess');
		 		}else{
		 			('#PhotoModal').modal('hide');
		 			toastr.error('Photo Upload Fail');
		 		}
		 	}).catch(function(error){
		 		$('#PhotoSave').html('save');
		 		toastr.error('Photo Upload Fail');
		 	})
		 })

		 PhotoJson();
		 // Photo Json
		 function PhotoJson(){

		 	axios.get('/PhotoJson')
		 	.then(function(response){		 		
		 		$.each(response.data, function(i, item){
		 			$("<div class='col-md-3'>").html(
		 				"<img data-id="+item['id']+" class='PhotoOnRow p-1' src="+item['location']+" alt=''>"+
		 				"<button data-id="+item['id']+" data-photo="+item['location']+" class='btn deletePhoto btn-sm btn-danger'>Delete</button>"
		 				).appendTo('.PhotoRow');

		 			// Photo Delete
		 			$('.deletePhoto').on('click',function(event){
		 				let id=$(this).data('id');
		 				let photo=$(this).data('photo');
		 				PhotoDelete(photo,id);
		 				event.preventDefault();
		 			})
		 		})
		 	}).catch(function(error){

		 	})
		 }


		 	var ImgId=0;
		 function LoadById(FirstImgId){

		 	 ImgId=ImgId+4;
		 	let PhotoId=ImgId+FirstImgId;
		 	let url= "/PhotoJsonById/"+PhotoId;
		 	$('#loadMoreBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
		 	axios.get(url)
		 		.then(function(response){
		 		$('#loadMoreBtn').html('Load More');		 		
		 		$.each(response.data, function(i, item){
		 			$("<div class='col-md-3'>").html(
		 				"<img data-id="+item['id']+" class='PhotoOnRow p-1' src="+item['location']+" alt=''>"+
		 				"<button data-id="+item['id']+" data-photo="+item['location']+" class='btn btn-sm btn-danger'>Delete</button>"
		 				).appendTo('.PhotoRow');
		 		})
		 	}).catch(function(error){

		 	})
		 }


		 $('#loadMoreBtn').on('click',function(){
		 	let FirstImgId=$(this).closest('div').find('img').data('id');		 	
		 	LoadById(FirstImgId);
		 })


		 function PhotoDelete(OldPhotoURL,id){
		 	let URL="/PhotoDelete";
		 	let MyFormData=new FormData();
		 	MyFormData.append('OldPhotoURL',OldPhotoURL);
		 	MyFormData.append('id',id);

		 	axios.post(URL,MyFormData)
		 	.then(function(response){
		 		if(response.status==200 && response.data==1){
		 			toastr.success('Photo Delete Success');
		 			window.location.href="/Photo";
		 		}else{
		 			toastr.error('Delete Fail Try Again');
		 		}

		 	}).catch(function(){
		 		toastr.error('Delete Fail Try Again');
		 	})

		 }



	</script>
@endsection