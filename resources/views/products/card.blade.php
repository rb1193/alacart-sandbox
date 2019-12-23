<article class="product">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <a href="{{ route('products.show', ['product' => $product]) }}">View more</a>
</article>