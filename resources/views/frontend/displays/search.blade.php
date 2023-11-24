@extends('frontend.master_dashboard')
@section('main')

<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">

                    <div class="breadcrumb">
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> {{ $item }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($tours) }}</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">



                <section class="product-tabs section-padding position-relative">
                    <div class="container wow animate__animated animate__fadeIn animate__slow">
                        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
                            @foreach($tours as $product)
                            @if($product->status ==1 )
                            <div class="col">
                                <div class="card">
                                    <img src="{{asset($product->product_thambnail)}}" height="280px" width="480px" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="stock-status in-stock">
                                            <span class="hot">Save 15%</span>
                                        </div>
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
            </div>
        </div>
      
    </div>
</div>




@endsection