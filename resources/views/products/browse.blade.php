@extends('layouts.app')  
  
@section('content')  
<div class="container">  
    <div class="columns justify-content-center">  
        <div class="column is-12">
            @if($products)
            <div class="column is-12">
                <button class="button is-primary is-inverted">
                    <a href="{{route('product.new')}}">
                        <b>Add New Product</b>
                    </a>  
                </button>
            </div>  
            <div class="columns">
                <div class="column is-9">  
                    @foreach($products as $product)  
                    <div class="column is-4 is-pulled-left">  
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-4by5">
                                    <a target="_blank" href="{{$product['image']}}">
                                    <img height="260" src="{{$product['image']}}" alt="Card image cap"></a>
                                </figure>
                            </div>
                            <div class="card-content">
                                <h5 class="card-header-title is-centered" style="
                                white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
                                ">{{$product['name']}}</h5>
                            </div>  
                        </div>  
                    </div>
                    @endforeach  
                </div>  
                <div class="column is-3 border">
                @foreach($tags as $tag)
                    <span class="tag is-info is-light is-medium" style="margin: 1% 0 1% 0;">
                        <a href="?tag={{$tag}}">{{$tag}}</a>
                    </span>
                @endforeach  
                </div>  
            </div>
            @else  
            <div class="card">  
                <div class="card-header-title is-centered">Browse Products</div>  
                <div class="column is-8">  
                    <div class="notification is-success" role="alert">  
                        Empty products! <a href="{{route('product.new')}}">Add Product</a>  
                    </div>  
                </div>  
            </div>  
            @endif  
        </div>  
    </div>  
</div>  
@endsection