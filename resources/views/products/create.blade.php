@extends('layouts.app')

@section('title', 'Create |')

@section('content')
<div class="container animate__animated animate__fadeIn">
    <div class="columns justify-content-center">
        <div class="column">
            <div class="card">
                <div class="card-header-title">New Product</div>
                    <div class="card-content">
                        <form method="POST" action="{{ route('product.store') }}">
                            {{ csrf_field() }}
                            <div class="field">
                                <label for="date">Date</label>
                                <br>
                                <input type="text" class="input" name="date_from" id="date_from" value="<?php echo date('Y-m-d'); ?>" readonly>
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="input" name="product_name" id="product_name" required placeholder="ex Headset Jack">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="product_image">Product Image</label>
                                <input type="text" class="input" name="product_image" id="product_image" required placeholder="Image url">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="tags">Tags</label>
                                <input type="text" class="input" name="tags" id="tags" required placeholder="Separate tags by comma">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="price">Price</label>
                                <input type="number" min="0" class="input" name="price" id="price" required placeholder="Price">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="spesification">Spesification</label><br>
                                <input type="button" id="AddRow"  class="btn btn-secondary" value="+">
                                <input type="button" id="RemoveRow" class="btn btn-secondary" value="-">
                                <table class="table">
                                    <tbody id="table">
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <button type="submit" class="button is-primary hvr-glow" style="color: #030303">
                                <span class="icon">
                                    <i class="fi-xwsuxl-plus-solid"></i>
                                </span>
                                <b>New Product</b>
                            </button>
                            <a class="button is-warning hvr-buzz" href="{{ route('product.all') }}">
                                <span class="icon">
                                    <i class="fi-xnsuxl-times-solid"></i>
                                </span>
                                <b style="color: black;">Discard</b>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 </div>
@endsection