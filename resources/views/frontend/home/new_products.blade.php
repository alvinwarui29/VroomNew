@php
$products = App\Models\Product::orderBy('product_name')->get();

@endphp


<section class="product-tabs section-padding position-relative">
<div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
					@foreach($products as $product)
					<div class="col">
						<div class="card">
							<img src="{{asset($product->product_thambnail)}}" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">{{$product->product_name}}</h5>
								<p style="max-height: 20px; overflow: hidden; text-overflow: ellipsis;" class="card-text">{{$product->short_descp}}</p>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">Price per person:Ksh{{$product->selling_price}}</li>
								<li class="list-group-item">Slots available:{{$product->product_qty}}</li>
								<li class="list-group-item">Agency name:{{$product->agency->name}}</li>
							</ul>
							<div class="card-body">
								<a onclick="joinRoom(this.id,'{{Auth::user()->id}}')" id="{{$product->id}}" class="btn btn-success px-5 radius-30">Join</a>
								<a href="#"  class="btn btn-dark px-5 radius-30">View Tour</a>
							</div>
						</div>
					</div>
					@endforeach
					
				</div>
				
    </section>