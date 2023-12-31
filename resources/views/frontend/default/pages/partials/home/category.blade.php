<style>
    .myclass{
        display: flex !important;
        justify-content: center;
        /* justify-content: space-evenly !important; */
        /* align-items: flex-start !important; */
    }
    .my-gshop-category-box{
        padding:10px 10px;
    }
    .gshop-animated-iconbox img:hover{
        border: 2px dashed black;
        border-radius: 5px;
    }
    .pt-60 {
        padding-top: 60px;
    }
    @media only screen and (max-width: 960px) {      
    #mycol{
        padding: 0% !important;
    }
    }
</style>
<section class="gshop-category-section bg-white pt-4 position-relative z-1 overflow-hidden">
    <img src="{{ staticAsset('frontend/default/assets/img/shapes/bg-shape.png') }}" alt="bg shape"
        class="position-absolute bottom-0 start-0 w-100 z--1">
    <div class="container">
        <div class="my-gshop-category-box border-0 rounded-3 bg-white">
            <div class="text-center section-title">
                <h4 class="d-inline-block px-2 bg-white mb-4">{{ localize('Our Top Categories') }}</h4>
            </div>
            <div class="row g-4 myclass">
                @php
                    $top_category_ids = getSetting('top_category_ids') != null ? json_decode(getSetting('top_category_ids')) : [];
                    $categories = \App\Models\Category::whereIn('id', $top_category_ids)->get();
                @endphp

                @foreach ($categories as $category)
                    @php
                        $productsCount = \App\Models\ProductCategory::where('category_id', $category->id)->count();
                    @endphp
                    <div class="col-md-3" id="mycol">
                        <a href="{{ route('products.index') }}?&category_id={{ $category->id }}">
                        <div class="gshop-animated-iconbox text-center position-relative overflow-hidden {{--{{ $loop->even ? 'color-2' : '' }}--}}">
                            <img src="{{ uploadedAsset($category->collectLocalization('thumbnail_image'))}}" class="w-100 rounded-2" alt="cate1">
                            {{-- <div class="animated-icon d-inline-flex align-items-center rounded-circle position-relative">
                                <img src="{{ uploadedAsset($category->collectLocalization('thumbnail_image')) }}"
                                    alt="" class="img-fluid">
                            </div>

                            <a href="{{ route('products.index') }}?&category_id={{ $category->id }}"
                                class="text-dark fs-sm fw-bold d-block mt-3">{{ $category->collectLocalization('name') }}</a>
                            <span
                                class="total-count position-relative ps-3 fs-sm fw-medium doted-primary">{{ $productsCount }}
                                {{ localize('Items') }}
                            </span>

                            <a href="{{ route('products.index') }}?&category_id={{ $category->id }}"
                                class="explore-btn position-absolute"><i class="fa-solid fa-arrow-up"></i>
                            </a> --}}
                        </div>
                        </a>
                    </div>                   
                @endforeach
            </div>
        </div>
    </div>
</section>
