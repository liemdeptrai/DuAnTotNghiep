@extends('layouts.app')

@section('content')
    <section class="section recent-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Recently Sold Items</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 15px;">
                @foreach ($products as $item)
                    <div class="col" style="flex: 1 0 20%; max-width: 20%;">
                        <div class="product-card">
                            <div class="product-media">
                                {{-- <div class="product-label">
                                    <label class="label-text sale">Sale</label>
                                </div> --}}
                                <button class="product-wish wish"><i class="fas fa-heart"></i></button>
                                <td class="centered">
                                    @if ($item->image)
                                        @php
                                            $images = json_decode($item->image);
                                        @endphp
                                        @if (is_array($images) || is_object($images)) 
                                            @foreach ($images as $image)
                                                <img src="{{ asset('storage/' . $image) }}" class="img-fluid" alt="Product Image" style="width: 150px; height: 150px; margin: 40px;">
                                            @endforeach
                                        @else
                                            <p>Invalid image data</p>
                                        @endif
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </td>
                                <div class="product-widget">
                                    <a title="Product Compare" href="compare.html" class="fas fa-random"></a>
                                    <a title="Product Video" href="" class="venobox fas fa-play"
                                        data-autoplay="true" data-vbtype="video"></a>
                                        <a title="Product View" href="{{ route('products.show', $item->id) }}" class="fas fa-eye"></a> <!-- Nút view -->
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                
                                <h6 class="product-name">
                                    <a href="product-video.html">
                                        {{ $item->name }}
                                    </a>
                                </h6>
                                <h6 class="product-price">
                                    <span>{{ $item->price }}<small>/piece</small></span>
                                </h6>

                                <form id="addToCartForm" action="{{ route('cart.add', ['itemId' => $item->id]) }}" method="POST">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1">
                                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                </form>
                                <div class="product-action">
                                    <button class="action-minus" title="Quantity Minus">
                                        <i class="icofont-minus"></i>
                                    </button>
                                    <input class="action-input" title="Quantity Number" type="text" name="quantity"
                                        value="1">
                                    <button class="action-plus" title="Quantity Plus">
                                        <i class="icofont-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25">
                        <a href="shop-4column.html" class="btn btn-outline">
                            <i class="fas fa-eye"></i><span>Show More</span>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
@endsection
