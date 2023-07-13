<style>
    .fw-grocery{
color:#fd7e14;
}
</style>
@if (productBasePrice($product) == discountedProductBasePrice($product))
    @if (productBasePrice($product) == productMaxPrice($product))
        <span class="fw-bold fw-grocery">{{ formatPrice(productBasePrice($product)) }}</span>
    @else
        <span class="fw-bold fw-grocery">{{ formatPrice(productBasePrice($product)) }}</span>
        -
        <span class="fw-bold fw-grocery">{{ formatPrice(productMaxPrice($product)) }}</span>
    @endif
@else
    @if (discountedProductBasePrice($product) == discountedProductMaxPrice($product))
        <span class="fw-bold fw-grocery">{{ formatPrice(discountedProductBasePrice($product)) }}</span>
    @else
        <span class="fw-bold fw-grocery">{{ formatPrice(discountedProductBasePrice($product)) }}</span>
        -
        <span class="fw-bold fw-grocery">{{ formatPrice(discountedProductMaxPrice($product)) }}</span>
    @endif

    @if (isset($br))
        <br>
    @endif

    @if (!isset($onlyPrice) || $onlyPrice == false)
        @if (productBasePrice($product) == productMaxPrice($product))
            <span
                class="fw-bold deleted text-muted {{ isset($br) ? '' : 'ms-1' }}">{{ formatPrice(productBasePrice($product)) }}</span>
        @else
            <span
                class="fw-bold deleted text-muted {{ isset($br) ? '' : 'ms-1' }}">{{ formatPrice(productBasePrice($product)) }}</span>
            -
            <span class="fw-bold deleted text-muted ms-1">{{ formatPrice(productMaxPrice($product)) }}</span>
        @endif
    @endif
@endif

@if ($product->unit)
    <small>/{{ $product->unit->collectLocalization('name') }}</small>
@endif