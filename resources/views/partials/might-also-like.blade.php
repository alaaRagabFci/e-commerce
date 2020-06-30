<div class="might-like-section">
    <div class="container">
        <h2>You might also like...</h2>
        <div class="might-like-grid">
            @foreach ($mightAlsoLike as $item)
            <a href="{{ url('/product-details', $item->slug) }}" class="might-like-product">
                <img src="{{ checkFileExist($item->image) }}" alt="product">
                <div class="might-like-product-name">{{ $item->name }}</div>
                <div class="might-like-product-price">{{ changePriceFormat($item->price) }}</div>
            </a>
            @endforeach
        </div>
    </div>
</div>
