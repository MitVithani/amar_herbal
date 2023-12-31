<ul class="tt-side-nav">

    <!-- dashboard -->
    <li class="side-nav-item nav-item">
        <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="pie-chart"></i></span>
            <span class="tt-nav-link-text">{{ localize('Dashboard') }}</span>
        </a>
    </li>

    <!-- products -->
    @php
        $productsActiveRoutes = ['admin.brands.index', 'admin.brands.edit', 'admin.units.index', 'admin.units.edit', 'admin.variations.index', 'admin.variations.edit', 'admin.variationValues.index', 'admin.variationValues.edit', 'admin.taxes.index', 'admin.taxes.edit', 'admin.categories.index', 'admin.categories.create', 'admin.categories.edit', 'admin.products.index', 'admin.products.create', 'admin.products.edit','admin.tags.index', 'admin.tags.edit'];
    @endphp

    @canany(['products', 'categories', 'variations', 'brands', 'units','tags','taxes'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($productsActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#sidebarProducts"
                aria-expanded="{{ areActiveRoutes($productsActiveRoutes, 'true') }}" aria-controls="sidebarProducts"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="shopping-bag"></i></span>
                <span class="tt-nav-link-text">{{ localize('Product Management') }}</span>
            </a>

            <div class="collapse {{ areActiveRoutes($productsActiveRoutes, 'show') }}" id="sidebarProducts">
                <ul class="side-nav-second-level">

                    @can('products')
                        <li
                            class="{{ areActiveRoutes(['admin.products.index', 'admin.products.create', 'admin.products.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.products.index') }}"
                                class="{{ areActiveRoutes(['admin.products.index', 'admin.products.create', 'admin.products.edit']) }}">{{ localize('All Products') }}</a>
                        </li>
                    @endcan

                    @can('categories')
                        <li
                            class="{{ areActiveRoutes(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.categories.index') }}"
                                class="{{ areActiveRoutes(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit']) }}">{{ localize('All Categories') }}</a>
                        </li>
                    @endcan

                    @can('variations')
                        <li
                            class="{{ areActiveRoutes(
                                ['admin.variations.index', 'admin.variations.edit', 'admin.variationValues.index', 'admin.variationValues.edit'],
                                'tt-menu-item-active',
                            ) }}">
                            <a href="{{ route('admin.variations.index') }}"
                                class="{{ areActiveRoutes([
                                    'admin.variations.index',
                                    'admin.variations.edit',
                                    'admin.variationValues.index',
                                    'admin.variationValues.edit',
                                ]) }}">{{ localize('Product Attributes') }}</a>
                        </li>
                    @endcan

                    @can('brands')
                        <li class="{{ areActiveRoutes(['admin.brands.index', 'admin.brands.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.brands.index') }}"
                                class="{{ areActiveRoutes(['admin.brands.index', 'admin.brands.edit']) }}">{{ localize('Brands') }}</a>
                        </li>
                    @endcan

                    @can('units')
                        <li class="{{ areActiveRoutes(['admin.units.index', 'admin.units.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.units.index') }}"
                                class="{{ areActiveRoutes(['admin.units.index']) }}">{{ localize('Units') }}</a>
                        </li>
                    @endcan
                 <!-- tags -->

                    @can('tags')
                        <li class="{{ areActiveRoutes(['admin.tags.index', 'admin.tags.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.tags.index') }}"
                                class="{{ areActiveRoutes(['admin.tags.index']) }}">{{ localize('Tags') }}</a>
                        </li>
                    @endcan

                    @can('taxes')
                        <li class="{{ areActiveRoutes(['admin.taxes.index', 'admin.taxes.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.taxes.index') }}"
                                class="{{ areActiveRoutes(['admin.taxes.index']) }}">{{ localize('Taxes') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcan

    <!-- pos -->
    @canany(['pos'])
        <li class="side-nav-item nav-item">
            <a href="{{ route('admin.pos.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"><i data-feather="table"></i></span>
                <span class="tt-nav-link-text">{{ localize('POS') }}</span>
            </a>
        </li>
    @endcan

    <!-- orders -->
    @php
    $orderActiveRoutes = ['admin.orders.index', 'admin.orders.show','admin.customers.index','admin.orderSettings','admin.timeslot.edit'];
    @endphp
    @canany(['orders','customers','order_settings','refuds'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($orderActiveRoutes,'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse"  href="#manageOrder"
                aria-expanded="{{ areActiveRoutes($orderActiveRoutes, 'true') }}" aria-controls="manageOrder"
                class="side-nav-link  tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="shopping-cart"></i></span>
                <span class="tt-nav-link-text">{{ localize('Order Manage') }}</span>
            </a>        

                        <div class="collapse {{ areActiveRoutes($orderActiveRoutes, 'show') }}" id="manageOrder">
                            <ul class="side-nav-second-level">
                                @can('add_stock')
                                    <li class="{{ areActiveRoutes(['admin.orders.index','admin.orders.show'], 'tt-menu-item-active') }}">
                                        <a href="{{ route('admin.orders.index') }}"
                                            class="{{ areActiveRoutes(['admin.orders.index']) }}">{{ localize('Orders') }}</a>
                                    </li>  
                                @endcan  

                                @can('customers')
                                <li class="{{ areActiveRoutes(['admin.customers.index'], 'tt-menu-item-active') }}">
                                    <a href="{{ route('admin.customers.index') }}"
                                        class="{{ areActiveRoutes(['admin.customers.index']) }}">{{ localize('Customers') }}</a>
                                </li>                               
                                @endcan   
                                @can('order_settings')
                                    <li
                                        class="{{ areActiveRoutes(['admin.orderSettings', 'admin.timeslot.edit'], 'tt-menu-item-active') }}">
                                        <a href="{{ route('admin.orderSettings') }}"
                                            class="{{ areActiveRoutes(['admin.generalSettings']) }}">{{ localize('Order Settings') }}</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>

                    @php
                        $newOrdersCount = \App\Models\Order::isPlaced()->count();
                    @endphp

                    @if ($newOrdersCount > 0)
                        <small class="badge bg-danger">{{ localize('New') }}</small>
                    @endif
                </span>
          
        </li>
    @endcan

    
    <!-- Refunds -->
    @php
        $refundsActiveRoutes = ['admin.refund.configurations', 'admin.refund.requests', 'admin.refund.refunded', 'admin.refund.rejected'];
    @endphp

    @canany(['refund_configurations', 'refund_requests', 'approved_refunds', 'rejected_refunds'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($refundsActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#manageRefunds"
                aria-expanded="{{ areActiveRoutes($refundsActiveRoutes, 'true') }}" aria-controls="manageRefunds"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="corner-up-left"></i></span>
                <span class="tt-nav-link-text">{{ localize('Refunds') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($refundsActiveRoutes, 'show') }}" id="manageRefunds">
                <ul class="side-nav-second-level">

                    @can('refund_configurations')
                        <li class="{{ areActiveRoutes(['admin.refund.configurations'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.refund.configurations') }}"
                                class="{{ areActiveRoutes(['admin.refund.configurations']) }}">{{ localize('Refund Configurations') }}</a>
                        </li>
                    @endcan

                    @can('refund_requests')
                        <li class="{{ areActiveRoutes(['admin.refund.requests'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.refund.requests') }}">{{ localize('Refund Requests') }}</a>
                        </li>
                    @endcan

                    @can('approved_refunds')
                        <li class="{{ areActiveRoutes(['admin.refund.refunded'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.refund.refunded') }}">{{ localize('Approved Refunds') }}</a>
                        </li>
                    @endcan

                    @can('rejected_refunds')
                        <li class="{{ areActiveRoutes(['admin.refund.rejected'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.refund.rejected') }}">{{ localize('Rejected Refunds') }}</a>
                        </li>
                    @endcan

                </ul>
            </div>
        </li>
    @endcan


    <!-- stock -->
    @php
        $stockActiveRoutes = ['admin.stocks.create', 'admin.locations.index', 'admin.locations.create', 'admin.locations.edit'];
    @endphp
    @canany(['add_stock', 'show_locations'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($stockActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#manageStock"
                aria-expanded="{{ areActiveRoutes($stockActiveRoutes, 'true') }}" aria-controls="manageStock"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="database"></i></span>
                <span class="tt-nav-link-text">{{ localize('Stock Manage') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($stockActiveRoutes, 'show') }}" id="manageStock">
                <ul class="side-nav-second-level">

                    @can('add_stock')
                        <li class="{{ areActiveRoutes(['admin.stocks.create'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.stocks.create') }}"
                                class="{{ areActiveRoutes(['admin.stocks.create']) }}">{{ localize('Add Stock') }}</a>
                        </li>
                    @endcan

                    @can('show_locations')
                        <li
                            class="{{ areActiveRoutes(['admin.locations.index', 'admin.locations.create', 'admin.locations.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.locations.index') }}">{{ localize('All Locations') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcan

      <!-- Appearance -->
      @php
      $appearanceActiveRoutes = ['admin.pages.index', 'admin.pages.create', 'admin.pages.edit','admin.appearance.header', 'admin.appearance.homepage.hero', 'admin.appearance.homepage.editHero', 'admin.appearance.homepage.topCategories', 'admin.appearance.homepage.topTrendingProducts', 'admin.appearance.homepage.featuredProducts', 'admin.appearance.homepage.bannerOne', 'admin.appearance.homepage.editBannerOne', 'admin.appearance.homepage.bestDeals', 'admin.appearance.homepage.bannerTwo', 'admin.appearance.homepage.clientFeedback', 'admin.appearance.homepage.editClientFeedback', 'admin.appearance.homepage.bestSelling', 'admin.appearance.products.index', 'admin.appearance.products.details', 'admin.appearance.products.details.editWidget', 'admin.appearance.about-us.popularBrands', 'admin.appearance.about-us.features', 'admin.appearance.about-us.editFeatures', 'admin.appearance.about-us.whyChooseUs', 'admin.appearance.about-us.editWhyChooseUs'];
      
      $homepageActiveRoutes = ['admin.appearance.homepage.hero', 'admin.appearance.homepage.editHero', 'admin.appearance.homepage.topCategories', 'admin.appearance.homepage.topTrendingProducts', 'admin.appearance.homepage.featuredProducts', 'admin.appearance.homepage.bannerOne', 'admin.appearance.homepage.editBannerOne', 'admin.appearance.homepage.bestDeals', 'admin.appearance.homepage.bannerTwo', 'admin.appearance.homepage.clientFeedback', 'admin.appearance.homepage.editClientFeedback', 'admin.appearance.homepage.bestSelling'];
      
    //   $pagesActiveRoutes = ['admin.pages.index', 'admin.pages.create', 'admin.pages.edit'];
      @endphp

    @canany(['homepage', 'product_page', 'product_details_page','pages', 'about_us_page', 'header', 'footer'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($appearanceActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#Appearance"
                aria-expanded="{{ areActiveRoutes($appearanceActiveRoutes, 'true') }}" aria-controls="Appearance"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="layout"></i></span>
                <span class="tt-nav-link-text">{{ localize('Website Page Setup') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($appearanceActiveRoutes, 'show') }}" id="Appearance">
                <ul class="side-nav-second-level">

                    @can('homepage')
                        <li class="{{ areActiveRoutes($homepageActiveRoutes, 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.homepage.hero') }}"
                                class="{{ areActiveRoutes($homepageActiveRoutes) }}">{{ localize('Homepage') }}</a>
                        </li>
                    @endcan


                    @can('product_page')
                        <li class="{{ areActiveRoutes(['admin.appearance.products.index'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.products.index') }}"
                                class="{{ areActiveRoutes(['admin.appearance.products.index']) }}">{{ localize('Product List') }}</a>
                        </li>
                    @endcan

                    @can('product_details_page')
                        <li
                            class="{{ areActiveRoutes(['admin.appearance.products.details', 'admin.appearance.products.details.editWidget'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.products.details') }}"
                                class="{{ areActiveRoutes(['admin.appearance.products.details']) }}">{{ localize('Product Details') }}</a>
                        </li>
                    @endcan

                    @can('pages')
                        <li
                            class="{{ areActiveRoutes(['admin.pages.index', 'admin.pages.create', 'admin.pages.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.pages.index') }}"
                                class="{{ areActiveRoutes(['admin.pages.index']) }}">{{ localize('Policy Pages') }}</a>
                        </li>
                       
                    @endcan

                    @can('about_us_page')
                        @php
                            $aboutUsActiveRoutes = ['admin.appearance.about-us.index', 'admin.appearance.about-us.popularBrands', 'admin.appearance.about-us.features', 'admin.appearance.about-us.editFeatures', 'admin.appearance.about-us.whyChooseUs', 'admin.appearance.about-us.editWhyChooseUs'];
                        @endphp

                        <li class="{{ areActiveRoutes($aboutUsActiveRoutes, 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.about-us.index') }}"
                                class="{{ areActiveRoutes($aboutUsActiveRoutes) }}">{{ localize('About Us') }}</a>
                        </li>
                    @endcan

                    @can('header')
                        <li class="{{ areActiveRoutes(['admin.appearance.header'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.header') }}"
                                class="{{ areActiveRoutes(['admin.appearance.header']) }}">{{ localize('Header') }}</a>
                        </li>
                    @endcan

                    @can('footer')
                        <li class="{{ areActiveRoutes(['admin.appearance.footer'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.footer') }}"
                                class="{{ areActiveRoutes(['admin.appearance.footer']) }}">{{ localize('Footer') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany

    <!--Marketing-->

    @php
        $marketingActiveRoutes = ['admin.coupons.index', 'admin.coupons.create', 'admin.coupons.edit','admin.campaigns.index', 'admin.campaigns.create', 'admin.campaigns.edit','admin.queries.index'];
    @endphp
    @canany(['coupons','campaigns','contact_us_messages'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($marketingActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#Marketing"
                aria-expanded="{{ areActiveRoutes($marketingActiveRoutes, 'true') }}" aria-controls="Marketing"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="scissors"></i></span>
                <span class="tt-nav-link-text">{{ localize('Marketing')}}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($marketingActiveRoutes, 'show') }}" id="Marketing">
                <ul class="side-nav-second-level">

            <!-- Coupons -->
                  @can('coupons')
                    <li class="{{ areActiveRoutes(['admin.coupons.index', 'admin.coupons.create', 'admin.coupons.edit'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.coupons.index')}}"
                            class="{{ areActiveRoutes(['admin.coupons.index']) }}">{{ localize('Coupons') }}</a>
                    </li>
                  @endcan

                  <!-- campaigns -->
                  @can('campaigns')                    
                    <li class="{{ areActiveRoutes(['admin.campaigns.index', 'admin.campaigns.create', 'admin.campaigns.edit'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.campaigns.index')}}"
                            class="{{ areActiveRoutes(['admin.campaigns.index']) }}">{{ localize('Campaigns') }}</a>
                    </li>
                  @endcan   

                  @can('contact_us_messages')

                  <li class="{{ areActiveRoutes(['admin.queries.index'], 'tt-menu-item-active') }}">
                    <a href="{{ route('admin.queries.index')}}"
                        class="{{ areActiveRoutes(['admin.queries.index']) }}">{{ localize('Queries') }}</a>
                        @php
                        $newMsgCount = \App\Models\ContactUsMessage::where('is_seen', 0)->count();
                    @endphp

                    @if ($newMsgCount > 0)
                        <small class="badge bg-danger">{{ localize('New') }}</small>
                    @endif
                 </li>

                @endcan

                </ul>
            </div>
        </li>
    @endcan    

    <!-- Rewards & Wallet -->
    @php
        $rewardsActiveRoutes = ['admin.rewards.configurations', 'admin.rewards.setPoints', 'admin.wallet.configurations'];
    @endphp
    @canany(['reward_configurations', 'set_reward_points'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($rewardsActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#manageRewards"
                aria-expanded="{{ areActiveRoutes($rewardsActiveRoutes, 'true') }}" aria-controls="manageRewards"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="award"></i></span>
                <span class="tt-nav-link-text">{{ localize('Rewards & Wallet') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($rewardsActiveRoutes, 'show') }}" id="manageRewards">
                <ul class="side-nav-second-level">

                    @can('reward_configurations')
                        <li class="{{ areActiveRoutes(['admin.rewards.configurations'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.rewards.configurations') }}"
                                class="{{ areActiveRoutes(['admin.rewards.configurations']) }}">{{ localize('Reward Configurations') }}</a>
                        </li>
                    @endcan

                    @can('set_reward_points')
                        <li class="{{ areActiveRoutes(['admin.rewards.setPoints'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.rewards.setPoints') }}">{{ localize('Set Reward Points') }}</a>
                        </li>
                    @endcan

                    @can('wallet_configurations')
                        <li class="{{ areActiveRoutes(['admin.wallet.configurations'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.wallet.configurations') }}"
                                class="{{ areActiveRoutes(['admin.wallet.configurations']) }}">{{ localize('Wallet Configurations') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcan

        <!-- Blog Systems -->
     @php
     $blogActiveRoutes = ['admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit', 'admin.blogCategories.index', 'admin.blogCategories.edit'];
     @endphp
 @canany(['blogs', 'blog_categories'])
     <li class="side-nav-item nav-item {{ areActiveRoutes($blogActiveRoutes, 'tt-menu-item-active') }}">
         <a data-bs-toggle="collapse" href="#blogSystem"
             aria-expanded="{{ areActiveRoutes($blogActiveRoutes, 'true') }}" aria-controls="blogSystem"
             class="side-nav-link tt-menu-toggle">
             <span class="tt-nav-link-icon"><i data-feather="file-text"></i></span>
             <span class="tt-nav-link-text">{{ localize('Blogs') }}</span>
         </a>
         <div class="collapse {{ areActiveRoutes($blogActiveRoutes, 'show') }}" id="blogSystem">
             <ul class="side-nav-second-level">
                 @can('blogs')
                     <li
                         class="{{ areActiveRoutes(['admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit'], 'tt-menu-item-active') }}">
                         <a href="{{ route('admin.blogs.index') }}"
                             class="{{ areActiveRoutes(['admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit']) }}">{{ localize('All Blogs') }}</a>
                     </li>
                 @endcan

                 @can('blog_categories')
                     <li
                         class="{{ areActiveRoutes(['admin.blogCategories.index', 'admin.blogCategories.edit'], 'tt-menu-item-active') }}">
                         <a href="{{ route('admin.blogCategories.index') }}">{{ localize('Categories') }}</a>
                     </li>
                 @endcan
             </ul>
         </div>
     </li>
 @endcan

  <!-- newsletter -->
  @php
  $newsletterActiveRoutes = ['admin.newsletters.index', 'admin.subscribers.index'];
@endphp
@canany(['newsletters', 'subscribers'])
  <li class="side-nav-item nav-item {{ areActiveRoutes($newsletterActiveRoutes, 'tt-menu-item-active') }}">
      <a data-bs-toggle="collapse" href="#newsletter"
          aria-expanded="{{ areActiveRoutes($newsletterActiveRoutes, 'true') }}" aria-controls="newsletter"
          class="side-nav-link tt-menu-toggle">
          <span class="tt-nav-link-icon"><i data-feather="map"></i></span>
          <span class="tt-nav-link-text">{{ localize('Newsletters') }}</span>
      </a>
      <div class="collapse {{ areActiveRoutes($newsletterActiveRoutes, 'show') }}" id="newsletter">
          <ul class="side-nav-second-level">

              @can('newsletters')
                  <li class="{{ areActiveRoutes(['admin.newsletters.index'], 'tt-menu-item-active') }}">
                      <a href="{{ route('admin.newsletters.index') }}"
                          class="{{ areActiveRoutes(['admin.newsletters.index']) }}">{{ localize('Bulk Emails') }}</a>
                  </li>
              @endcan

              @can('subscribers')
                  <li class="{{ areActiveRoutes(['admin.subscribers.index'], 'tt-menu-item-active') }}">
                      <a href="{{ route('admin.subscribers.index') }}"
                          lass="{{ areActiveRoutes(['admin.newsletters.index']) }}">{{ localize('Subscribers') }}</a>
                  </li>
              @endcan
          </ul>
      </div>
  </li>
@endcan

@php
$reportActiveRoutes = ['admin.reports.orders', 'admin.reports.sales', 'admin.reports.categorySales', 'admin.reports.salesAmount', 'admin.reports.deliveryStatus'];
@endphp

@canany(['order_reports', 'product_sale_reports', 'category_sale_reports', 'sales_amount_reports',
'delivery_status_reports'])
<li class="side-nav-item nav-item {{ areActiveRoutes($reportActiveRoutes, 'tt-menu-item-active') }}">
    <a data-bs-toggle="collapse" href="#reports"
        aria-expanded="{{ areActiveRoutes($reportActiveRoutes, 'true') }}" aria-controls="reports"
        class="side-nav-link tt-menu-toggle">
        <span class="tt-nav-link-icon"><i data-feather="bar-chart"></i></span>
        <span class="tt-nav-link-text">{{ localize('Reports') }}</span>
    </a>
    <div class="collapse {{ areActiveRoutes($reportActiveRoutes, 'show') }}" id="reports">
        <ul class="side-nav-second-level">

            @can('order_reports')
                <li class="{{ areActiveRoutes(['admin.reports.orders'], 'tt-menu-item-active') }}">
                    <a href="{{ route('admin.reports.orders') }}"
                        class="{{ areActiveRoutes(['admin.reports.orders']) }}">{{ localize('Orders Report') }}</a>
                </li>
            @endcan

            @can('product_sale_reports')
                <li class="{{ areActiveRoutes(['admin.reports.sales'], 'tt-menu-item-active') }}">
                    <a href="{{ route('admin.reports.sales') }}"
                        class="{{ areActiveRoutes(['admin.reports.sales']) }}">{{ localize('Product Sales') }}</a>
                </li>
            @endcan

            @can('category_sale_reports')
                <li class="{{ areActiveRoutes(['admin.reports.categorySales'], 'tt-menu-item-active') }}">
                    <a href="{{ route('admin.reports.categorySales') }}"
                        class="{{ areActiveRoutes(['admin.reports.categorySales']) }}">{{ localize('Category Wise Sales') }}</a>
                </li>
            @endcan

            @can('sales_amount_reports')
                <li class="{{ areActiveRoutes(['admin.reports.salesAmount'], 'tt-menu-item-active') }}">
                    <a href="{{ route('admin.reports.salesAmount') }}"
                        class="{{ areActiveRoutes(['admin.reports.salesAmount']) }}">{{ localize('Sales Amount Reports') }}</a>
                </li>
            @endcan

            @can('delivery_status_reports')
                <li class="{{ areActiveRoutes(['admin.reports.deliveryStatus'], 'tt-menu-item-active') }}">
                    <a href="{{ route('admin.reports.deliveryStatus') }}"
                        class="{{ areActiveRoutes(['admin.reports.deliveryStatus']) }}">{{ localize('Delivery Reports') }}</a>
                </li>
            @endcan
        </ul>
    </div>
</li>
@endcan
    
    <!-- pages -->
    {{-- @php
        $pagesActiveRoutes = ['admin.pages.index', 'admin.pages.create', 'admin.pages.edit'];
    @endphp
    @can('pages')
        <li class="side-nav-item nav-item {{ areActiveRoutes($pagesActiveRoutes, 'tt-menu-item-active') }}">
            <a href="{{ route('admin.pages.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"> <i data-feather="copy"></i></span>
                <span class="tt-nav-link-text">{{ localize('Pages') }}</span>
            </a>
        </li>
    @endcan --}}


    {{-- <!-- Blog Systems -->
    @php
        $blogActiveRoutes = ['admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit', 'admin.blogCategories.index', 'admin.blogCategories.edit'];
    @endphp
    @canany(['blogs', 'blog_categories'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($blogActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#blogSystem"
                aria-expanded="{{ areActiveRoutes($blogActiveRoutes, 'true') }}" aria-controls="blogSystem"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="file-text"></i></span>
                <span class="tt-nav-link-text">{{ localize('Blogs') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($blogActiveRoutes, 'show') }}" id="blogSystem">
                <ul class="side-nav-second-level">
                    @can('blogs')
                        <li
                            class="{{ areActiveRoutes(['admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.blogs.index') }}"
                                class="{{ areActiveRoutes(['admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit']) }}">{{ localize('All Blogs') }}</a>
                        </li>
                    @endcan

                    @can('blog_categories')
                        <li
                            class="{{ areActiveRoutes(['admin.blogCategories.index', 'admin.blogCategories.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.blogCategories.index') }}">{{ localize('Categories') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcan --}}

    <!-- media manager -->
    @can('media_manager')
        <li class="side-nav-item">
            <a href="{{ route('admin.mediaManager.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"> <i data-feather="folder"></i></span>
                <span class="tt-nav-link-text">{{ localize('Media Manager') }}</span>
            </a>
        </li>
    @endcan

    {{-- <!-- newsletter -->
    @php
        $newsletterActiveRoutes = ['admin.newsletters.index', 'admin.subscribers.index'];
    @endphp
    @canany(['newsletters', 'subscribers'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($newsletterActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#newsletter"
                aria-expanded="{{ areActiveRoutes($newsletterActiveRoutes, 'true') }}" aria-controls="newsletter"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="map"></i></span>
                <span class="tt-nav-link-text">{{ localize('Newsletters') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($newsletterActiveRoutes, 'show') }}" id="newsletter">
                <ul class="side-nav-second-level">

                    @can('newsletters')
                        <li class="{{ areActiveRoutes(['admin.newsletters.index'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.newsletters.index') }}"
                                class="{{ areActiveRoutes(['admin.newsletters.index']) }}">{{ localize('Bulk Emails') }}</a>
                        </li>
                    @endcan

                    @can('subscribers')
                        <li class="{{ areActiveRoutes(['admin.subscribers.index'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.subscribers.index') }}"
                                lass="{{ areActiveRoutes(['admin.newsletters.index']) }}">{{ localize('Subscribers') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcan --}}

    {{-- <!-- Coupons -->
    @can('coupons')
        <li
            class="side-nav-item nav-item {{ areActiveRoutes(['admin.coupons.index', 'admin.coupons.create', 'admin.coupons.edit'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.coupons.index') }}"
                class="side-nav-link {{ areActiveRoutes(['admin.coupons.index', 'admin.coupons.create', 'admin.coupons.edit']) }}">
                <span class="tt-nav-link-icon"> <i data-feather="scissors"></i></span>
                <span class="tt-nav-link-text">{{ localize('Coupons') }}</span>
            </a>
        </li>
    @endcan

    <!-- campaigns -->
    @can('campaigns')
        <li
            class="side-nav-item nav-item {{ areActiveRoutes(['admin.campaigns.index', 'admin.campaigns.create', 'admin.campaigns.edit'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.campaigns.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"> <i data-feather="zap"></i></span>
                <span class="tt-nav-link-text">{{ localize('Campaigns') }}</span>
            </a>
        </li>
    @endcan --}}

    <!-- Fulfillment -->
    {{-- <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Fulfillment') }}</span>
    </li>
    <!-- Logistics -->
    @can('logistics')
        <li
            class="side-nav-item nav-item {{ areActiveRoutes(['admin.logistics.index', 'admin.logistics.create', 'admin.logistics.edit'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.logistics.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"><i data-feather="cpu"></i></span>
                <span class="tt-nav-link-text">{{ localize('Logistics') }}</span>
            </a>
        </li>
    @endcan --}}

    {{-- <!-- shipping zones -->
    @php
        $logisticZoneActiveRoutes = ['admin.logisticZones.index', 'admin.logisticZones.create', 'admin.logisticZones.edit', 'admin.countries.index', 'admin.states.index', 'admin.states.create', 'admin.states.edit', 'admin.cities.index', 'admin.cities.create', 'admin.cities.edit'];
    @endphp
    @can('shipping_zones')
        <li class="side-nav-item nav-item {{ areActiveRoutes($logisticZoneActiveRoutes, 'tt-menu-item-active') }}">
            <a href="{{ route('admin.logisticZones.index') }}" class="side-nav-link">
                <i class="uil-ship"></i>
                <span class="tt-nav-link-icon"><i data-feather="truck"></i></span>
                <span class="tt-nav-link-text">{{ localize('Shipping Zones') }}</span>
            </a>
        </li>
    @endcan --}}

    <!-- Reports -->
    {{-- <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Reports') }}</span>
    </li> --}}

    <!-- reports -->
    {{-- @php
        $reportActiveRoutes = ['admin.reports.orders', 'admin.reports.sales', 'admin.reports.categorySales', 'admin.reports.salesAmount', 'admin.reports.deliveryStatus'];
    @endphp

    @canany(['order_reports', 'product_sale_reports', 'category_sale_reports', 'sales_amount_reports',
        'delivery_status_reports'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($reportActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#reports"
                aria-expanded="{{ areActiveRoutes($reportActiveRoutes, 'true') }}" aria-controls="reports"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="bar-chart"></i></span>
                <span class="tt-nav-link-text">{{ localize('Reports') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($reportActiveRoutes, 'show') }}" id="reports">
                <ul class="side-nav-second-level">

                    @can('order_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.orders'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.orders') }}"
                                class="{{ areActiveRoutes(['admin.reports.orders']) }}">{{ localize('Orders Report') }}</a>
                        </li>
                    @endcan

                    @can('product_sale_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.sales'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.sales') }}"
                                class="{{ areActiveRoutes(['admin.reports.sales']) }}">{{ localize('Product Sales') }}</a>
                        </li>
                    @endcan

                    @can('category_sale_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.categorySales'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.categorySales') }}"
                                class="{{ areActiveRoutes(['admin.reports.categorySales']) }}">{{ localize('Category Wise Sales') }}</a>
                        </li>
                    @endcan

                    @can('sales_amount_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.salesAmount'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.salesAmount') }}"
                                class="{{ areActiveRoutes(['admin.reports.salesAmount']) }}">{{ localize('Sales Amount Report') }}</a>
                        </li>
                    @endcan

                    @can('delivery_status_reports')
                        <li class="{{ areActiveRoutes(['admin.reports.deliveryStatus'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.reports.deliveryStatus') }}"
                                class="{{ areActiveRoutes(['admin.reports.deliveryStatus']) }}">{{ localize('Delivery Status Report') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcan --}}


    <!-- Support -->
    {{-- <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Support') }}</span>
    </li> --}}

    {{-- @can('contact_us_messages')
        <li class="side-nav-item nav-item {{ areActiveRoutes(['admin.queries.index'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.queries.index') }}"
                class="side-nav-link {{ areActiveRoutes(['admin.queries.index']) }}">
                <span class="tt-nav-link-icon"><i data-feather="hash"></i></span>
                <span class="tt-nav-link-text">
                    <span>{{ localize('Queries') }}</span>

                    @php
                        $newMsgCount = \App\Models\ContactUsMessage::where('is_seen', 0)->count();
                    @endphp

                    @if ($newMsgCount > 0)
                        <small class="badge bg-danger">{{ localize('New') }}</small>
                    @endif
                </span>
            </a>
        </li>
    @endcan --}}

    <!-- Settings -->
    {{-- <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Settings') }}</span>
    </li> --}}

  

    {{-- @canany(['homepage', 'product_page', 'product_details_page', 'about_us_page', 'header', 'footer'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($appearanceActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#Appearance"
                aria-expanded="{{ areActiveRoutes($appearanceActiveRoutes, 'true') }}" aria-controls="Appearance"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="layout"></i></span>
                <span class="tt-nav-link-text">{{ localize('Appearance') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($appearanceActiveRoutes, 'show') }}" id="Appearance">
                <ul class="side-nav-second-level">

                    @can('homepage')
                        <li class="{{ areActiveRoutes($homepageActiveRoutes, 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.homepage.hero') }}"
                                class="{{ areActiveRoutes($homepageActiveRoutes) }}">{{ localize('Homepage') }}</a>
                        </li>
                    @endcan


                    @can('product_page')
                        <li class="{{ areActiveRoutes(['admin.appearance.products.index'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.products.index') }}"
                                class="{{ areActiveRoutes(['admin.appearance.products.index']) }}">{{ localize('Products Page') }}</a>
                        </li>
                    @endcan

                    @can('product_details_page')
                        <li
                            class="{{ areActiveRoutes(['admin.appearance.products.details', 'admin.appearance.products.details.editWidget'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.products.details') }}"
                                class="{{ areActiveRoutes(['admin.appearance.products.details']) }}">{{ localize('Product Details') }}</a>
                        </li>
                    @endcan

                    @can('about_us_page')
                        @php
                            $aboutUsActiveRoutes = ['admin.appearance.about-us.index', 'admin.appearance.about-us.popularBrands', 'admin.appearance.about-us.features', 'admin.appearance.about-us.editFeatures', 'admin.appearance.about-us.whyChooseUs', 'admin.appearance.about-us.editWhyChooseUs'];
                        @endphp

                        <li class="{{ areActiveRoutes($aboutUsActiveRoutes, 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.about-us.index') }}"
                                class="{{ areActiveRoutes($aboutUsActiveRoutes) }}">{{ localize('About Us') }}</a>
                        </li>
                    @endcan

                    @can('header')
                        <li class="{{ areActiveRoutes(['admin.appearance.header'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.header') }}"
                                class="{{ areActiveRoutes(['admin.appearance.header']) }}">{{ localize('Header') }}</a>
                        </li>
                    @endcan

                    @can('footer')
                        <li class="{{ areActiveRoutes(['admin.appearance.footer'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.footer') }}"
                                class="{{ areActiveRoutes(['admin.appearance.footer']) }}">{{ localize('Footer') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}   


    <!-- system settings -->
    @php
        $settingsActiveRoutes = ['admin.generalSettings', 'admin.orderSettings', 'admin.timeslot.edit', 'admin.languages.index', 'admin.languages.edit', 'admin.currencies.index', 'admin.currencies.edit', 'admin.languages.localizations', 'admin.smtpSettings.index','admin.logisticZones.index', 'admin.logisticZones.create', 'admin.logisticZones.edit', 'admin.countries.index', 'admin.states.index', 'admin.states.create', 'admin.states.edit', 'admin.cities.index', 'admin.cities.create', 'admin.cities.edit','admin.logistics.index', 'admin.logistics.create', 'admin.logistics.edit'];
    @endphp

    @canany(['smtp_settings','Logistics','general_settings', 'currency_settings', 'language_settings','Shipping_Zones'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($settingsActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#systemSetting"
                aria-expanded="{{ areActiveRoutes($settingsActiveRoutes, 'true') }}" aria-controls="systemSetting"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="settings"></i></span>
                <span class="tt-nav-link-text">{{ localize('Website Settings') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($settingsActiveRoutes, 'show') }}" id="systemSetting">
                <ul class="side-nav-second-level">

                    @can('language_settings')
                        <li
                            class="{{ areActiveRoutes(
                                ['admin.languages.index', 'admin.languages.edit', 'admin.languages.localizations'],
                                'tt-menu-item-active',
                            ) }}">
                            <a href="{{ route('admin.languages.index') }}"
                                class="{{ areActiveRoutes(['admin.languages.index', 'admin.languages.edit', 'admin.languages.localizations']) }}">{{ localize('Multi Language') }}</a>
                        </li>
                    @endcan

                    @can('currency_settings')
                        <li
                            class="{{ areActiveRoutes(
                                ['admin.currencies.index', 'admin.currencies.edit', 'admin.currencies.localizations'],
                                'tt-menu-item-active',
                            ) }}">
                            <a href="{{ route('admin.currencies.index') }}"
                                class="{{ areActiveRoutes(['admin.currencies.index', 'admin.currencies.edit', 'admin.currencies.localizations']) }}">{{ localize('Multi Currency') }}</a>
                        </li>
                    @endcan

                    @can('payment_settings')
                    <li class="{{ areActiveRoutes(['admin.settings.paymentMethods'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.settings.paymentMethods') }}"
                            class="{{ areActiveRoutes(['admin.settings.paymentMethods']) }}">{{ localize('Payment Methods') }}</a>
                    </li>
                   @endcan

                    @can('general_settings')
                    <li class="{{ areActiveRoutes(['admin.generalSettings'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.generalSettings') }}"
                            class="{{ areActiveRoutes(['admin.generalSettings']) }}">{{ localize('General Settings') }}</a>
                    </li>
                    @endcan
                    
                    <!-- shipping zones -->
                    @can('Shipping_Zones')
                    <li class="{{ areActiveRoutes(['admin.logisticZones.index'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.logisticZones.index') }}"
                            class="{{ areActiveRoutes(['admin.logisticZones.index']) }}">{{ localize('Shipping Zones') }}</a>
                    </li>
                    @endcan                     

                    <!-- Logistics -->
                    @can('Logistics')
                    <li class="{{ areActiveRoutes(['admin.logistics.index', 'admin.logistics.create', 'admin.logistics.edit'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.logistics.index') }}"
                            class="{{ areActiveRoutes(['admin.logistics.index']) }}">{{ localize('Logistics') }}</a>
                    </li>
                    @endcan      
                    
                    @can('smtp_settings')
                    <li class="{{ areActiveRoutes(['admin.smtpSettings.index'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.smtpSettings.index') }}"
                            class="{{ areActiveRoutes(['admin.smtpSettings.index']) }}">{{ localize('E-mail SMTP') }}</a>
                    </li>
                    @endcan 

                    @can('otp_settings')
                        <li class="{{ areActiveRoutes(['admin.settings.otpSettings'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.settings.otpSettings') }}"
                                class="{{ areActiveRoutes(['admin.settings.otpSettings']) }}">{{ localize('OTP Settings') }}</a>
                        </li>
                    @endcan                    

                    <li class="d-none {{ areActiveRoutes(['admin.smtpSettings.index'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.smtpSettings.index') }}"
                            class="{{ areActiveRoutes(['admin.smtpSettings.index']) }}">{{ localize('Admin Store') }}</a>
                    </li>                               

                   @can('auth_settings')
                    <li class="{{ areActiveRoutes(['admin.settings.authSettings'], 'tt-menu-item-active') }}">
                        <a href="{{ route('admin.settings.authSettings') }}"
                            class="{{ areActiveRoutes(['admin.settings.authSettings']) }}">{{ localize('Auth Settings') }}</a>
                    </li>
                   @endcan

                   @can('social_login_settings')
                   <li class="{{ areActiveRoutes(['admin.settings.socialLogin'], 'tt-menu-item-active') }}">
                       <a href="{{ route('admin.settings.socialLogin') }}"
                           class="{{ areActiveRoutes(['admin.settings.socialLogin']) }}">{{ localize('Social Media Login') }}</a>
                   </li>
                  @endcan

                    
                </ul>
            </div>
        </li>
    @endcan  

    <!-- staffs -->
    @php
        $staffActiveRoute=['admin.staffs.index', 'admin.staffs.create', 'admin.staffs.edit','admin.roles.index', 'admin.roles.create', 'admin.roles.edit'];
    @endphp
     @can('staffs')
     <li class="side-nav-item nav-item {{ areActiveRoutes($staffActiveRoute, 'tt-menu-item-active') }}">
        <a data-bs-toggle="collapse" href="#staff"
            aria-expanded="{{ areActiveRoutes($staffActiveRoute, 'true') }}" aria-controls="staff"
            class="side-nav-link tt-menu-toggle">
            <span class="tt-nav-link-icon"><i data-feather="user-check"></i></span>
            <span class="tt-nav-link-text">{{ localize('System Settings') }}</span>
        </a>
        <div class="collapse {{ areActiveRoutes($staffActiveRoute, 'show') }}" id="staff">
            <ul class="side-nav-second-level">

                @can('staffs')
                <li class="{{ areActiveRoutes(['admin.staffs.index', 'admin.staffs.create', 'admin.staffs.edit'], 'tt-menu-item-active') }}">
                    <a href="{{ route('admin.staffs.index') }}"
                        class="{{ areActiveRoutes(['admin.staffs.index']) }}">{{ localize('Employees staffs') }}</a>
                </li>
               @endcan

                 <!-- Roles & Permission -->
                 @can('roles_and_permissions')
                 <li class="{{ areActiveRoutes(['admin.roles.index', 'admin.roles.create', 'admin.roles.edit'], 'tt-menu-item-active') }}">
                     <a href="{{ route('admin.roles.index') }}"
                         class="{{ areActiveRoutes(['admin.roles.index']) }}">{{ localize('Roles & Permissions') }}</a>
                 </li>
                @endcan
            </ul>
        </div>
     </li>
     @endcan
    
  

      <!-- Users -->
      {{-- <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Users') }}</span>
    </li> --}}

    <!-- customers -->
    {{-- @can('customers')
        <li class="side-nav-item nav-item">
            <a href="{{ route('admin.customers.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"> <i data-feather="users"></i></span>
                <span class="tt-nav-link-text">{{ localize('Customers') }}</span>
            </a>
        </li>
    @endcan --}}

    <!-- Contents -->
    {{-- <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Contents') }}</span>
    </li> --}}

   

    
    {{-- <!-- Promotions -->
    <li class="side-nav-title side-nav-item nav-item">
        <span class="tt-nav-title-text">{{ localize('Promotions') }}</span>
    </li> --}}

  

</ul>
