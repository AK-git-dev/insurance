@extends('layouts.frontLayout.front-layout')
@section('title', 'Sell Us | '.$result['model'])
@section('content')
<section class="left-main-bg">
	<div class="container ">
	  <div class="row">
	  	<div class="col-md-5 d-none d-md-block">
          
            <div class="right-block mob-profile-page pt-4">

   <div class="card mt-2 my-3 mob-bg">

      <img src="{{ asset('/public/rider/images/profile-cover.png')}}" class="img-fluid prof-mob-bg d-lg-none" />

      <div class="profile-page-block  p-0 p-lg-4">


         <div class="rider-details-block w-100 order-1 order-md-2">
            <div class="location-heading-block ">
               <div><h3 class="profile-user-name pb-2">{{ucwords($result['model'])}} </h3></div>
            </div>

            <div class="mob-white-bg">
                <div class="pl-2">                    
                    <table class="table table-responsive">
                        <tr><td><strong>Color</strong> </td><td>{{$result['color']}}</td></tr>
                        <tr><td><strong>DL Registration</strong> </td><td>{{$result['dl_registration']}}</td></tr>

                        @if($result['dl_registration'] == 'Yes')
                        <tr><td><strong>DL Registration</strong> </td><td>{{$result['dl_registration_date']}}</td></tr>
                        @endif

                        @if($result['is_insurance'] == 'Yes')
                        <tr><td><strong>Insurance Valid Till</strong></td><td> {{$result['insurance_expiry_date']}}</td></tr>
                        @endif

                        <tr><td><strong>Category</strong> </td><td>{{$result['category']}}</td></tr>
                        <tr><td><strong>Brand</strong> </td><td>{{$result['brand']}}</td></tr>
                        <tr><td><strong>Kms Done</strong> </td><td>{{$result['km_done']}}</td></tr>
                        <tr><td><strong>Condition</strong> </td><td>{{$result['condition']}}</td></tr>
                        <tr><td><strong>Accidental</strong> </td><td>{{$result['is_accidental']}}</td></tr>
                        <tr><td><strong>Owner</strong> </td><td>{{$result['owner']}}</td></tr>

                        <tr><td><strong>Location</strong> </td><td>{{$result['city']}}</td></tr>
                        <tr><td><strong>Throttle Rides Price</strong> </td><td>Rs. {{$result['total_price']}}</td></tr>
                        <tr><td><strong>Added By</strong> </td><td>{{$result['added_by']}}</td></tr>
                        <tr><td><strong>Email Address</strong> </td><td>{{$result['email']}}</td></tr>
                    </table>
                </div>
            </div>

            <div class="pt-3">
                <p class="font-weight-bold">Accessories</p>
                <ul class="">
                    @foreach($result['accessories'] as $accessory)
                    <li>- {{$accessory->name}}</li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-danger pb-2">Rs. {{$result['total_price']}}</h4>
                <button type="button" class="post-btn lg px-5 ml-auto">Book Now</button>
            </div>

         </div>

      </div>

   </div>



   <!-- Update Description Modal -->

   
            </div>
		</div>
		<div class="col-md-7">
		  <div class="cust-left-block">
                <div class="col-12 ride_detail_nav">

                    <ol class="breadcrumb bg-white px-0">

                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                    <li class="breadcrumb-item"><a href="{{route('supply_bikes.index')}}">Sell Us</a></li>

                    <li class="breadcrumb-item active" aria-current="page">{{$result['slug']}}
                    
                    </li>

                    </ol>

                </div>
		  		
				<div class="d-flex align-items-center filter-details mb-2"></div>
				
                <h4 class="pb-3">{{ucwords($result['model'])}}</h4>
                <div class="row">
                    <div class="bike_image_slide slider">   
                        <span class="position-relative d-block cover-pic-block"> 
                            <img src="{{ asset('public/images/supply_bikes/')}}/{{$result['image'] }}" class="img-fluid">
                        </span>                         
                        @foreach($result['images'] as $image)                            
                        <span class="position-relative d-block cover-pic-block"> 
                            <img src="{{ asset('public/images/supply_bikes/')}}/{{$image}}" class="img-fluid">
                        </span>
                        @endforeach
                    </div>      
                </div>

            <h4 class="pt-4">Related Bikes</h4>
            <div class="row">
            @if(count($result['related_bikes']) > 0)
				@foreach($result['related_bikes'] as $key => $bike)                
                <div class="col-12 mb-3 tip_referer_{{$bike['id']}}">
                <div class="rides-block d-none d-md-flex">
					<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">                       
                    <a href="{{route('supply_bikes.show', $bike['slug'])}}" class="href">
                        <img src="{{ asset('public/images/supply_bikes/')}}/{{$bike['image'] }}" class="img-fluid" width="250" height="180">
                    </a>
					</div>
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div>
							<h4 class="location-title">
                                <a href="{{route('supply_bikes.show', $bike['slug'])}}" class="location-title">{{$bike['model']}}</a>
                            </h4>
							<div class="d-flex align-items-center location-block">
								<span class="time">Added on <span class="text-danger">{{$bike['added_on']}}</span></span>
								<span class="time left-seperater">Added By <span class="text-danger">{{$bike['added_by']}}</span></span>
							</div>
						</div>						
					</div>
					<div class="location-details d-flex align-items-center">
						<span class="other-details">
							<i class="fa fa-tag text-warning"></i>{{ $bike['category']}} <small>Category</small>
						</span>
						<span class="other-details">
							<i class="fa fa-motorcycle text-danger"></i>{{ $bike['brand']}} <small>Brand</small>
						</span>
						<span class="other-details">
                        <i class="fa fa-inr"></i> {{ucfirst($bike['total_price'])}} <small>Sell Price</small>
						</span>										
					</div>

					

					<div class="userdetails d-flex align-items-center">
						<span class="username">
							<span class="d-block"></span>
						<span class="badge badge-warning">
						</span>
						</span>
					</div>
					<div>
						
					</div>
					
					</div>
				</div>
                </div>
                @endforeach
			@else
				<div class="col-12 mb-3">
					<h4 class="location-title my-2">Record Not Found</h4>
				</div>
			@endif	
            </div>		   
		  </div>
		</div>		
	  </div>
	</div>
  </section>
@stop
<style>
.bike_image_slide {
  margin: 0 auto;
  width: 700px;
}

ul {
    list-style-type: none;
}

ul li {
    line-height: 30px;
}


</style>