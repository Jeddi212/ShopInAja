@extends('layouts.app')

@section('title', '| Detail')

@section('content')
    <div class="container animate__animated animate__fadeIn">
        <div class="columns">
            <div class="column is-12">
                <div class="column is-12">
                    <a class="button is-primary hvr-backward" href="{{route('product.all')}}">
                        <span class="icon">
                            <i class="fi-xnslxl-chevron-solid"></i>
                        </span>
                        <b style="color: white;">Back</b>
                    </a>
                    <a class="button is-danger hvr-buzz" href="{{route('product.all')}}">
                        <span class="icon">
                            <i class="fi-xnsuxl-trash-bin"></i>
                        </span>
                        <b style="color: white;">Delete</b>
                    </a>
                </div>
                <div class="columns">
                    <div class="column is-4">
                        <div class="container box">
                            <figure class="image is-4by5 is-480x600">
                            <img src="{{$product['image']}}">
                            </figure>
                        </div>
                    </div>
                    <div class="column is-8">
                        <div class="container box">
                            <div class="heading">
                                <h1 class="title">Nama Barang</h1>
                            </div>
                            <section class="">
                                <table class="table is-striped">
                                    @foreach($product as $key => $value)
                                    @if ($key != "image")
                                    <tr>
                                        <td width="30%">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                        <td>: {{ $value }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </table>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection