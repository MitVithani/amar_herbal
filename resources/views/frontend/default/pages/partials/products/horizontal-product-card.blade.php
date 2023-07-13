<style>
    .fw-button{
        border-radius: 25px 25px;
        /* width: 322px; */
    }
</style>
<div class="align-items-center p-3 bg-white border card-md" style="border-radius:10px;">
    <div class="row">
        <div class="col-12">
            <div class="thumbnail position-relative rounded-2 text-center">
                <a href="{{ route('products.show', $product->slug) }}"><img src="{{ uploadedAsset($product->thumbnail_image) }}" alt="product"
                        class="img-fluid" width="45%"></a>
                    {{-- <div class="product-overlay position-absolute start-0 top-0 w-100 h-100 d-flex align-items-center justify-content-center gap-1 rounded-2">
                        @if (Auth::check() && Auth::user()->user_type == 'customer')
                            <a href="javascript:void(0);" class="rounded-btn"><i class="fa-regular fa-heart"
                                    onclick="addToWishlist({{ $product->id }})"></i></a>
                        @elseif(!Auth::check())
                            <a href="javascript:void(0);" class="rounded-btn"><i class="fa-regular fa-heart"
                                    onclick="addToWishlist({{ $product->id }})"></i></a>
                        @endif

                        <a href="javascript:void(0);" class="rounded-btn" onclick="showProductDetailsModal({{ $product->id }})"><i
                                class="fa-regular fa-eye"></i></a>
                    </div>  --}}
            {{-- @if (Auth::check() && Auth::user()->user_type == 'customer')
                <a href="javascript:void(0);" class="rounded-btn fs-xs" onclick="addToWishlist({{ $product->id }})"><i
                        class="fa-regular fa-heart"></i></a>
            @elseif(!Auth::check())
                <a href="javascript:void(0);" class="rounded-btn fs-xs" onclick="addToWishlist({{ $product->id }})"><i
                        class="fa-regular fa-heart"></i></a>
            @endif

            <a href="javascript:void(0);" class="rounded-btn fs-xs"
                onclick="showProductDetailsModal({{ $product->id }})"><i class="fa-solid fa-eye"></i></a> --}}
       
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-content mt-2">
                <a href="{{ route('products.show', $product->slug) }}"
                    class="fw-bold text-heading title fs-sm tt-line-clamp tt-clamp-1"  style="font-size:20px !important;color:black;">{{ $product->collectLocalization('name') }}
                </a>
                <a href="{{ route('products.show', $product->slug) }}"
                    class="card-titles mb-2 tt-line-clamp tt-clamp-2" style="font-size:15px;color:#696767;font-weight:400">{{ $product->collectLocalization('short_description') }}
                </a>
                <h6 class="pricing mt-2">
                    @include('frontend.default.pages.partials.products.pricing', [
                        'product' => $product,
                        'onlyPrice' => true,
                    ])
                </h6>

                @php
                    $isVariantProduct = 0;
                    $stock = 0;
                    if ($product->variations()->count() > 1) {
                        $isVariantProduct = 1;
                    } else {
                        $stock = $product->variations[0]->product_variation_stock->stock_qty;
                    }
                @endphp

                @if ($isVariantProduct)
                    {{-- <a href="javascript:void(0);" class="fs-xs fw-bold mt-10 d-inline-block explore-btn"
                        onclick="showProductDetailsModal({{ $product->id }})">{{ localize('Buy Now') }}<span class="ms-1"><i
                                class="fa-solid fa-arrow-right"></i></span></a> --}}
                                <a href="javascript:void(0);" class="btn btn-secondary btn-md fw-button"
                        onclick="showProductDetailsModal({{ $product->id }})" style="width:100% !important">{{ localize('Order Now') }}</a>
                @else
                    <form action="" class="direct-add-to-cart-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="product_variation_id" value="{{ $product->variations[0]->id }}">
                        <input type="hidden" value="1" name="quantity">

                        @if (!$isVariantProduct && $stock < 1)
                            <button type="button" class="fs-xs fw-bold mt-10 d-inline-block explore-btn" style="width:100% !important">
                                {{ localize('Out of Stock') }}
                                {{-- <span class="ms-1"><i class="fa-solid fa-arrow-right"></i></span> --}}
                            </button>
                        @else
                            <button type="button" onclick="directAddToCartFormSubmit(this)"
                                class="btn btn-secondary btn-md fw-button" style="width:100% !important">
                                <span class="add-to-cart-text">{{ localize('Order Now') }}</span>
                                {{-- <span class="ms-1"><i class="fa-solid fa-arrow-right"></i></span> --}}
                            </button>
                        @endif
                    </form>
                @endif

            </div>
        </div>
    </div>
    
</div>