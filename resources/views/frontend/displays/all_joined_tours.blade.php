@extends('frontend.master_dashboard')
@section('main')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            
        </div>
    </div>
</div>
@foreach($tours as $product)

@if($product->discount_price)
@php
$amount = $product->selling_price - $product->discount_price;
$discountD = ($amount/$product->selling_price) * 100;
$discount = round($discountD);
@endphp
@endif
<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
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

                            <!-- THUMBNAILS -->
                            
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

@endsection