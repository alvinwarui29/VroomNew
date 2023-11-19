<!-- @php

$products = App\Models\Product::orderBy('product_name')
->whereRaw('joined <= product_qty') ->get();


	@endphp -->


<section class="product-tabs section-padding position-relative">
	<div class="container wow animate__animated animate__fadeIn">
		<div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
			@foreach($products as $product)
			<div class="col">
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
						<a type="button"  id="{{ $product->id }}" class="{{$isjoined ? 'btn btn-secondary px-5 radius-30 ': 'btn btn-success px-5 radius-30 '}}">Joined</a>
						@else
						<a type="button" onclick="joinRoom(this.id, '{{ $id}}')" id="{{ $product->id }}" class="{{$isjoined ? 'btn btn-secondary px-5 radius-30 ': 'btn btn-success px-5 radius-30 '}}"> {{$isjoined ? 'Joined' : 'Join '}} </a>
						@endif
						<a href="{{url('/view/single/tour/'.$product->id.'/'.$product->product_slug)}}" type="button" style="color:#198754; border:solid #198754" class="btn btn-outline-success px-5 radius-30">View Tour</a>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>

</section>