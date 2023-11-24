@extends('frontend.master_dashboard')
@section('main')



<!--End hero slider-->
@include('frontend.home.featured_categories')

<!--End category slider-->
<!--End banners-->

<!-- 
	@include('frontend.home.home_slider') -->
@include('frontend.home.new_products')

<!--Products Tabs-->



@include('frontend.home.features_product')


<!--End Best Sales-->




<!-- TV Category -->

<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn animate__slow">
            <h3>TV Category </h3>

        </div>
        <!--End nav-tabs-->
        <div class="tab-content wow animate__animated animate__fadeIn animate__slow" id="myTabContent">
        @foreach($specific_products as $product)

        @php
        $amount = $product->selling_price - $product->discount_price;
        $discountD = ($amount/$product->selling_price) * 100;
        $discount = round($discountD);
        @endphp
        <div class="container mb-30 wow animate__animated animate__fadeIn animate__slow">
            <div class="row">
                <div class="col-xl-10 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($product->product_thambnail) }}" alt="product image" height="600px" />
                                        </figure>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    @if($product->discount_price == NULL)
                                    <span class="stock-status in-stock">New</span>
                                    @else
                                    <span class="stock-status out-stock"> {{ round($discount) }} %</span>
                                    @endif
                                    <h2 class="title-detail">{{$product->product_name}}</h2>
                                    <div class="product-detail-rating">
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            @if($product->discount_price == NULL)
                                            <span class="current-price text-brand">Kshs{{$product->selling_price}}</span>
                                            @else
                                            <span class="current-price text-brand">Kshs{{$product->discount_price}}</span>
                                            <span>
                                                <span style="font-size: 14px;" class="save-price font-md color3 ml-15">{{$discount}}%</span>
                                                <span class="old-price font-md ml-15">Kshs{{$product->selling_price}}%</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                    $available_slots =$product->product_qty - $product->joined
                                    @endphp
                                    <div class="short-desc mb-30">
                                        <p class="font-lg"><span class="stock-status in-stock">Short description: </span>{{ $product->short_descp}}</p>
                                        <p class="font-lg"><span class="stock-status in-stock">Total slots: </span>{{ $product->product_qty}}</p>
                                        <p class="font-lg"><span class="stock-status in-stock">Available slots: </span>{{ $available_slots}}</p>
                                        <p class="font-lg"><span class="stock-status in-stock">By: </span>{{ $product->agency->name}}</p>
                                    </div>
                                 
                                    <div class="detail-extralink mb-50">
                                        @php
                                        $isjoined = App\Models\JoinedTour::where('user_id',Auth()->user()->id)->where('product_id',$product->id)->first();
                                        @endphp
                                        @if($isjoined == NULL)
                                        <a type="button" onclick="joinRoomV(this.id, '{{ Auth::user()->id }}')" id="{{ $product->id }}" class=" btn btn-success px-5 radius-30 "> Join Room </a>
                                        @else

                                        <a type="button" onclick="leaveRoom(this.id, '{{ Auth::user()->id }}')" id="{{ $product->id }}" class=" btn btn-danger px-5 radius-30 "> Leave room </a>
                                        @endif
                                    </div>

                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </div>

</section>





<!-- Tshirt Category -->

<section class="product-tabs section-padding position-relative">
	<div class="container wow animate__animated animate__fadeIn animate__slow">
		<div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
			@foreach($tshirt as $product)
			@if($product->status ==1 )
			<div class="col">
				<div class="card">
					<img src="{{asset($product->product_thambnail)}}" height="280px" width="480px" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">{{$product->product_name}}</h5>
						<p style="max-height: 20px; overflow: hidden; text-overflow: ellipsis;" class="card-text">{{$product->short_descp}}</p>
						<div class="product-badges product-badges-position product-badges-mrg">
							<span class="hot">Save 15%</span>
						</div>
					</div>
					@php
					$slots =$product->product_qty;
					$joined =$product->joined;
					$difference = $slots - $joined;
					@endphp
					<ul class="list-group list-group-flush">
						<li class="list-group-item">Price per person:Ksh{{$product->selling_price}}</li>
						<li class="list-group-item">Total slots:{{$slots}}</li>
						<li class="list-group-item">Slots available:{{$difference}}</li>
						<li class="list-group-item">Agency name:{{$product->agency->name}}</li>
					</ul>
					<div class="card-body">
						@php
						if(auth()->check()) {
						$isjoined = App\Models\JoinedTour::where('user_id',Auth()->user()->id)->where('product_id',$product->id)->first();
						$id = Auth::user()->id;
						}else{
						$isjoined = false;
						$id = null;
						}
						@endphp
						@if($isjoined)
						<a type="button" id="{{ $product->id }}" class="{{$isjoined ? 'btn btn-secondary px-5 radius-30 ': 'btn btn-success px-5 radius-30 '}}">Joined</a>
						@else
						<a type="button" onclick="joinRoom(this.id, '{{ $id}}')" id="{{ $product->id }}" class="{{$isjoined ? 'btn btn-secondary px-5 radius-30 ': 'btn btn-success px-5 radius-30 '}}"> {{$isjoined ? 'Joined' : 'Join '}} </a>
						@endif
						<a href="{{url('/view/single/tour/'.$product->id.'/'.$product->product_slug)}}" type="button" style="color:#198754; border:solid #198754" class="btn btn-outline-success px-5 radius-30">View Tour</a>
					</div>
				</div>
			</div>
			@endif
			@endforeach

		</div>
	</div>

</section>
<!--End Tshirt Category -->








<!-- Computer Category -->

<section class="product-tabs section-padding position-relative">
	<div class="container wow animate__animated animate__fadeIn animate__slow">
		<div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
			@foreach($computer as $product)
			@if($product->status ==1 )
			<div class="col">
				<div class="card">
					<img src="{{asset($product->product_thambnail)}}" height="280px" width="480px" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">{{$product->product_name}}</h5>
						<p style="max-height: 20px; overflow: hidden; text-overflow: ellipsis;" class="card-text">{{$product->short_descp}}</p>
						<div class="product-badges product-badges-position product-badges-mrg">
							<span class="hot">Save 15%</span>
						</div>
					</div>
					@php
					$slots =$product->product_qty;
					$joined =$product->joined;
					$difference = $slots - $joined;
					@endphp
					<ul class="list-group list-group-flush">
						<li class="list-group-item">Price per person:Ksh{{$product->selling_price}}</li>
						<li class="list-group-item">Total slots:{{$slots}}</li>
						<li class="list-group-item">Slots available:{{$difference}}</li>
						<li class="list-group-item">Agency name:{{$product->agency->name}}</li>
					</ul>
					<div class="card-body">
						@php
						if(auth()->check()) {
						$isjoined = App\Models\JoinedTour::where('user_id',Auth()->user()->id)->where('product_id',$product->id)->first();
						$id = Auth::user()->id;
						}else{
						$isjoined = false;
						$id = null;
						}
						@endphp
						@if($isjoined)
						<a type="button" id="{{ $product->id }}" class="{{$isjoined ? 'btn btn-secondary px-5 radius-30 ': 'btn btn-success px-5 radius-30 '}}">Joined</a>
						@else
						<a type="button" onclick="joinRoom(this.id, '{{ $id}}')" id="{{ $product->id }}" class="{{$isjoined ? 'btn btn-secondary px-5 radius-30 ': 'btn btn-success px-5 radius-30 '}}"> {{$isjoined ? 'Joined' : 'Join '}} </a>
						@endif
						<a href="{{url('/view/single/tour/'.$product->id.'/'.$product->product_slug)}}" type="button" style="color:#198754; border:solid #198754" class="btn btn-outline-success px-5 radius-30">View Tour</a>
					</div>
				</div>
			</div>
			@endif
			@endforeach

		</div>
	</div>

</section>
<!--End Computer Category -->







<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-1.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Nestle Original Coffee-Mate Coffee Creamer</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-2.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Nestle Original Coffee-Mate Coffee Creamer</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-3.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Nestle Original Coffee-Mate Coffee Creamer</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                <div class="product-list-small animated animated">
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-4.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Organic Cage-Free Grade A Large Brown Eggs</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-5.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Seeds of Change Organic Quinoa, Brown, & Red Rice</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-6.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Naturally Flavored Cinnamon Vanilla Light Roast Coffee</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-7.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Pepperidge Farm Farmhouse Hearty White Bread</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-8.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Organic Frozen Triple Berry Blend</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-9.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Oroweat Country Buttermilk Bread</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-10.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Foster Farms Takeout Crispy Classic Buffalo Wings</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-11.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Angie’s Boomchickapop Sweet & Salty Kettle Corn</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-12.jpg') }}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">All Natural Italian-Style Chicken Meatballs</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->



<!--Vendor List -->

@include('frontend.home.vendor_list')

<!--End Vendor List -->

@endsection