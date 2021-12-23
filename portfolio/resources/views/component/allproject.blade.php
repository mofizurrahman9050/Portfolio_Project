<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <img class=" page-top-img fadeIn" src="{{asset('image/knowledge.svg')}}">
            <h1 class="page-top-title mt-3">- প্রজেক্টস সমূহ -</h1>
        </div>
    </div>
</div>

 <div class="container section-marginTop text-center mt-5">      
        <div class="row">
            <div id="one"  class="owl-carousel mb-4 owl-theme">

                @foreach($projectData as $projectData)
                <div class="item m-1 card">
                    <div class="text-center">
                        <img class="w-100 h-50" src="{{($projectData->project_img)}}" alt="Card image cap">
                        <h5 class="service-card-title mt-4">{{($projectData->project_name   )}}</h5>
                        <h6 class="service-card-subTitle p-0 m-0">{{($projectData->project_des)}}</h6>
                        <a target="_blank" class="normal-btn-outline mt-2 mb-4 btn btn btn-primary">{{($projectData->project_link)}}</a>
                    </div>
                </div>
                @endforeach

            

            </div>
        </div>
        <div class="d-inline ml-2">
            <i id="customPrevBtn" class="btn normal-btn"><</i>
            <i id="customNextBtn" class="btn normal-btn">></i>
            <button class="normal-btn  btn">সব গুলো </button>
        </div>
    </div>