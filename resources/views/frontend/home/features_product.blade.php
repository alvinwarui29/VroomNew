<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn animate__slow">
            <h3 class=""> Tour categories</h3>

        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn animate__slow">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your life</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @foreach($categories as $cat)
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div style="width: 100px; height:100px;" class="product-img product-img-zoom">
                                            <a href="{{route('view.specific.tours',$cat->id)}}">
                                                <img class="default-img" style="max-width: 100%; max-height: 100%;" src="{{ asset('uploads/categories_images/'.$cat->category_image)}}" alt="categories" />
                                            </a>
                                        </div>
                                        <!-- <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                </div> -->
                                        <!-- DIscount span -->
                                        <!-- <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Save 15%</span>
                                                </div> -->
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <h1 style="font-size: 20px;"><a style="font-size: 20px;" href="{{route('view.specific.tours',$cat->id)}}">{{$cat->category_name}}</a></h1>
                                        </div>
                                        @if($cat->tours_count > 0)
                                        @php
                                        $totalPrice = 0;
                                        $persons =0;
                                        @endphp
                                        @foreach($cat->tours as $tour)
                                        @php
                                        $persons += $tour->product_qty;
                                        $totalPrice += $tour->selling_price ;
                                        @endphp
                                        @endforeach
                                        @php
                                            $averagePrice = $totalPrice / $cat->tours_count;
                                        @endphp
                                        <div class="product-price mt-10">
                                            <span>Average Price Ksh{{ $averagePrice }} </span>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>People joined {{ $persons }} </span>
                                        </div>
                                        @else
                                        <div class="product-price mt-10">
                                            <span>Average Price Ksh{{ 0 }} </span>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>People joined {{ 0 }} </span>
                                        </div>
                                        @endif
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> {{$cat->tours_count}} tours found</span>
                                    
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                                <!--End product Wrap-->


                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->


                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>