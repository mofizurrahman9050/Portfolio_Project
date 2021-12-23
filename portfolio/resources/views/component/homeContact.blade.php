
<div class="container-fluid section-marginTop parallax text-center mb-4 mt-5">
    <div class="row ">
        <div class="col-md-6 contact-form ">
            <h5 class="help-line-title mt-5"> <i class="fas icon-custom-color fa-headphones-alt"></i> হেলপ লাইন </h5>
            <h5 class="help-line-title m-0">০১৯১১৯৪৯০৫০ </h5>
        </div>
        <div class="col-md-4 contact-form">
                <h5 class="service-card-title">যোগাযোগ করুন</h5>
                <div class="form-group ">
                    <input id="ContactName" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="ContactMobile" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="ContactEmail" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="ContactMsg" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtnId" class="btn btn-block normal-btn btn-primary w-100">পাঠিয়ে দিন </button>
        </div>
        <div class="col-md-2">

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
        <h5 id="ServiceDeleteId" class="mt-5 d-none"></h5>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="ServiceDeleteConformBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
        
  


@section('script')
<script type="text/javascript">
    

$('#contactSendBtnId').click(function(){
    var contactName=$('#ContactName').val();
    var contactMobile=$('#ContactMobile').val();
    var contactEmail=$('#ContactEmail').val();
    var contactMsg=$('#ContactMsg').val();
    SendContact(contactName,contactMobile,contactEmail,contactMsg);
})




function SendContact(contactName,contactMobile,contactEmail,contactMsg){

    if(contactName.length==0){
        $('#contactSendBtnId').html('আপনার নাম লিখুন!');
        setTimeout(function(){
          $('#contactSendBtnId').html('পাঠীয়ে দিন');  
        },2000)
    }else if(contactMobile.length==0){
        $('#contactSendBtnId').html('আপনার মোবাইল নং লিখুন!');
          setTimeout(function(){
          $('#contactSendBtnId').html('পাঠীয়ে দিন');  
        },2000)
    }else if(contactEmail.length==0){
        $('#contactSendBtnId').html('আপনার ইমেইল লিখুন!');
          setTimeout(function(){
          $('#contactSendBtnId').html('পাঠীয়ে দিন');  
        },2000)
    }else if(contactMsg.length==0){
        $('#contactSendBtnId').html('আপনার মেসেজ লিখুন!');
          setTimeout(function(){
          $('#contactSendBtnId').html('পাঠীয়ে দিন');  
        },2000)
    }else{
        $('#contactSendBtnId').html('পাঠানো হচ্ছে'); 
         axios.post('/ContactSend',{
        contact_name:contactName,
        contact_mobile:contactMobile,
        contact_email:contactEmail,
        contact_msg:contactMsg
    })
    .then(function(response){
        if(response.status==200 && response.data==1){
            $('#contactSendBtnId').html('আবেদন সফল হয়েছে');
        setTimeout(function(){
          $('#contactSendBtnId').html('পাঠীয়ে দিন');  
        },3000)
        }else{
            $('#contactSendBtnId').html('আবেদন ব্যার্ঠ হয়েছে');
        setTimeout(function(){
          $('#contactSendBtnId').html('পাঠীয়ে দিন');  
        },3000)
        }

    }).catch(function(error){
        $('#contactSendBtnId').html('আবেদন ব্যার্ঠ হয়েছে');
        setTimeout(function(){
          $('#contactSendBtnId').html('পাঠীয়ে দিন');  
        },3000)
    }) 
    }
  
}
</script>

@endsection