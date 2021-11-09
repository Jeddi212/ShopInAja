@extends('layouts.app')

@section('content')
<div class="container animate__animated animate__fadeIn">
    <div class="columns justify-content-center">
        <div class="column is-12">
            @if($products)
            <div class="column is-12">
                <a class="button is-primary is-inverted hvr-bob" href="{{ route('product.new') }}">
                    <b>Add New Product</b>
                </a>
            </div>
            <div class="columns">
                <div class="column is-9">
                    @foreach($products as $product)
                    <div class="column is-4 is-pulled-left">
                        <a href="{{ route('product.details', ['product_id' => $product['product_id']]) }}">
                        <div class="card hvr-glow">
                            <div class="card-image">
                                <figure class="image is-4by5">
                                        <img height="260" src="{{ $product['image'] }}" alt="Card image cap">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <h5 class="title is-6" style="
                                white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
                                ">{{$product['name']}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="column is-3">
                @foreach($tags as $tag)
                    <a class="tag is-info is-light is-medium hvr-push" href="?tag={{ $tag }}" 
                        style="margin: 1% 0 1% 0; text-decoration: none;" >
                        <small>{{ $tag }}</small>
                    </a>
                @endforeach
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header-title is-centered">Browse Products</div>
                <div class="column is-8">
                    <div class="notification is-success" role="alert">
                        Empty products! <a href="{{ route('product.new') }}">Add Product</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>  
</div>  
@endsection