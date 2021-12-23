    <div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <img class=" page-top-img fadeIn" src="{{asset('image/code.svg')}}">
            <h1 class="page-top-title mt-3">সার্ভিস সমূহ -</h1>
        </div>
    </div>
</div>

    <div class="container text-center mt-5">    
      <div class="row icon-boxes">

        @foreach($serviceData as $serviceData)
       <div class="col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">        
        <div class="card" style="width: 18rem; height: 400px;">

          <img src="{{($serviceData->service_img)}}" class="card-img-top h-50" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{($serviceData->service_name)}}</h5>
            <p class="card-text">{{($serviceData->service_des)}}</p>
            <a href="{{('$serviceData->service_link')}}" target="_blank" class="btn btn-primary">Go somewhere</a>
          </div>  
        </div>
      </div> 
      @endforeach

 

  </div>
</div>
