@extends('layouts.app')

@section('content')

    <div class="container">

        <h2>{{ $product->name }}</h2>

        <div>
            @if ($images && (is_array($images) || is_object($images)))
                @foreach ($images as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" style="width: 300px; height: auto;">
                @endforeach
            @else
                <p>Không có hình ảnh nào.</p>
            @endif
        </div>

        <p>{{ $product->description }}</p>
        <h4>Giá: {{ $product->price }} VND</h4>

        <form id="addToCartForm"
      action="{{ route('cart.add', ['itemId' => $product->id, 'quantity' => 1]) }}"
      method="post">
    @csrf
    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
</form>

    </div>

@endsection
