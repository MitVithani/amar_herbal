<style>
    .qnthidden{
        display: none !important;
    }
</style>
<div class="gstore-product-quick-view bg-white rounded-3 py-6 px-4">
    <div class="row g-4">
        <div class="col-xl-6 align-self-end">
            <!-- sliders -->
            @include('frontend.default.pages.partials.products.sliders', compact('product'))
            <!-- sliders -->
        </div>
        <div class="col-xl-6">
            <div class="product-info">
                <h3 class="mt-1 mb-3 h5">{{ $product->collectLocalization('name') }}</h3>

                <!--product category start-->
                @if ($product->categories()->count() > 0)
                <div class="tt-category-tag mt-3">
                    @foreach ($product->categories as $category)
                        <a href="{{ route('products.index') }}?&category_id={{ $category->id }}"
                            class="text-muted fs-xxs">{{ $category->collectLocalization('name') }}</a>
                    @endforeach
                </div>
                @endif
                <!--product category end-->

                <!--description start-->
                <div class="widget-title d-flex mt-4">
                    <h6 class="mb-1 flex-shrink-0">{{ localize('Description') }}</h6>
                    <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
                </div>
                <p class="mb-3">
                    {{ $product->collectLocalization('short_description') }}
                </p>                
                <!--description end-->        

               
                <form action="" class="add-to-cart-form">
                    @php
                        $isVariantProduct = 0;
                        $stock = 0;
                        if ($product->variations()->count() > 1) {
                            $isVariantProduct = 1;
                        } else {
                            $stock = $product->variations[0]->product_variation_stock->stock_qty;
                        }
                    @endphp     
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="product_variation_id"
                        @if (!$isVariantProduct) value="{{ $product->variations[0]->id }}" @endif>
    
                    <!-- variations -->
                    @include('frontend.default.pages.partials.products.variations', compact('product'))
                    <!-- variations -->


                     <!-- pricing -->
                    <div class="pricing all-pricing mt-2">
                        @include('frontend.default.pages.partials.products.pricing', compact('product'))
                    </div>
                    <!-- pricing -->

                    <!-- selected variation pricing -->
                    <div class="pricing variation-pricing mt-2 d-none">

                    </div>
                    <!-- selected variation pricing -->              


                    <div class="d-flex align-items-center gap-3 flex-wrap mt-5">
                        
                        <div id="quantity-container" class="qnthidden product-qty qty-increase-decrease d-flex align-items-center">
                            <button type="button" class="decrease">-</button>
                            <input type="text" readonly value="1" name="quantity" min="1"
                                @if (!$isVariantProduct) max="{{ $stock }}" @endif>
                            <button type="button" class="increase">+</button>
                        </div>

                        <button type="submit" id="add-to-cart" onclick="showQuantityInput()" class="btn btn-secondary btn-md add-to-cart-btn"
                            @if (!$isVariantProduct && $stock < 1) disabled @endif>
                            <span class="me-2">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </span>
                            <span class="add-to-cart-text">
                                @if (!$isVariantProduct && $stock < 1)
                                    {{ localize('Out of Stock') }}
                                @else
                                    {{ localize('Add to Cart') }}
                                @endif
                            </span>
                        </button>

                        <button type="button" class="btn btn-primary btn-md"
                            onclick="addToWishlist({{ $product->id }})">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </div>                    
                </form>

            </div>
        </div>
    </div>
</div>

<script>
     function showQuantityInput() {
      document.getElementById('add-to-cart').classList.add('qnthidden');
      document.getElementById('quantity-container').classList.remove('qnthidden');
    }
</script>
