@extends('layouts.shopfront')

@section('title', 'Products')

@section('content')
    <h1>Products</h1>
    <section class="products">
        @each('products.card', $products, 'product', 'products.empty')
        {{ $products->links() }}
    </section>
@endsection