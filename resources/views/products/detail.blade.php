@extends('layouts.app')

@section('title', '| Detail')

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <div class="column is-12">
                    <button class="button is-primary">
                        <span class="icon">
                            <i class="fi-xnslxl-chevron-solid"></i>
                        </span>
                        <a href="{{route('product.all')}}">
                            <b style="color: white;">Back</b>
                        </a>
                    </button>
                    <button class="button is-danger">
                        <span class="icon">
                            <i class="fi-xnsuxl-trash-bin"></i>
                        </span>
                        <a href="{{route('product.all')}}">
                            <b style="color: white;">Delete</b>
                        </a>
                    </button>
                </div>
                <div class="columns">
                    <div class="column is-4">
                        <div class="container box">
                            <figure class="image is-4by5 is-480x600">
                            <img src="https://bulma.io/images/placeholders/480x600.png">
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
                                    @for($i = 0; $i < 10; $i++)
                                    <tr>
                                        <td width="30%">Key {{ $i }} : </td>
                                        <td>Value</td>
                                    </tr>
                                    @endfor
                                </table>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection