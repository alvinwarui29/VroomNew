@extends('frontend.master_dashboard')
@section('main')

@php
$amount = $product->selling_price - $product->discount_price;
$discountD = ($amount/$product->selling_price) * 100;
$discount = round($discountD);
@endphp

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="shop-grid-right.html">{{$product->product_name}}</a> <span></span> {{$product->product_slug}}
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">

                                @foreach($multiImage as $img)
                                <figure class="border-radius-10">
                                    <img src="{{ asset($img->photo_name) }}" alt="product image" height="600px" />
                                </figure>
                                @endforeach
                            </div>

                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails">
                                @foreach($multiImage as $img)
                                <div><img src="{{asset ( $img->photo_name )}}" alt="product image" /></div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Gallery -->
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
                                <p class="font-lg">Short description:{{$product->short_descp}}</p>
                                <p class="font-lg">Total slots:{{$product->product_qty}}</p>
                                <p class="font-lg">Available slots:{{$available_slots}}</p>
                                <p class="font-lg">By:{{$product->agency->name}}</p>
                            </div>
                            <!-- add to cart -->
                            <!-- <div class="detail-extralink mb-50">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="quantity" class="qty-val" value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                </div>
                            </div> -->
                            <!-- //end to cart -->
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
                <div class="product-info">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div class="">
                                    <p> {!! $product->long_descp !!} </p>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Vendor-info">
                                <div class="vendor-logo d-flex mb-30">
                                    <img src="assets/imgs/vendor/vendor-18.svg" alt="" />
                                    <div class="vendor-name ml-15">
                                        <h6>
                                            <a href="vendor-details-2.html">Noodles Co.</a>
                                        </h6>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="contact-infor mb-50">
                                    <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined Kent, Utah 53127 United States</span></li>
                                    <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>(+91) - 540-025-553</span></li>
                                </ul>
                                <div class="d-flex mb-55">
                                    <div class="mr-30">
                                        <p class="text-brand font-xs">Rating</p>
                                        <h4 class="mb-0">92%</h4>
                                    </div>
                                    <div class="mr-30">
                                        <p class="text-brand font-xs">Ship on time</p>
                                        <h4 class="mb-0">100%</h4>
                                    </div>
                                    <div>
                                        <p class="text-brand font-xs">Chat response</p>
                                        <h4 class="mb-0">89%</h4>
                                    </div>
                                </div>
                                <p>Noodles & Company is an American fast-casual restaurant that offers international and American noodle dishes and pasta in addition to soups and salads. Noodles & Company was founded in 1995 by Aaron Kennedy and is headquartered in Broomfield, Colorado. The company went public in 2013 and recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles & Company locations across 29 states and Washington, D.C.</p>
                            </div>
                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->

                                <!--comment form-->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">Related products</h2>
                    </div>
                    <div class="col-12">
                        <section class="product-tabs section-padding position-relative">
                            <div class="container wow animate__animated animate__fadeIn">
                                <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
                                    @foreach($otherProducts as $product)
                                    @if($product->status ==1 )
                                    <div style="width: 400px;" class="col">
                                        <div class="card">
                                            <img src="{{asset($product->product_thambnail)}}" height="280px" width="480px" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$product->product_name}}</h5>
                                                <p style="max-height: 20px; overflow: hidden; text-overflow: ellipsis;" class="card-text">{{$product->short_descp}}</p>
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
                                            <div class="card-body ">
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
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection