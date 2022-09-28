<style>
    .navbar-vertical .nav-link {
        color: #041562;
        
        /* font-weight: bold; */
    }

    .navbar .nav-link:hover {
        color: #041562;
    }

    .navbar .active > .nav-link, .navbar .nav-link.active, .navbar .nav-link.show, .navbar .show > .nav-link {
        color: #F14A16;
    }

    .navbar-vertical .active .nav-indicator-icon, .navbar-vertical .nav-link:hover .nav-indicator-icon, .navbar-vertical .show > .nav-link > .nav-indicator-icon {
        color: #F14A16;
    }

    .nav-subtitle {
        display: block;
        color: #041562;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03125rem;
    }

    .side-logo {
        background-color: #ffffff;
    }

    .nav-sub {
        background-color: #ffffff!important;
    }

    .nav-indicator-icon {
        margin-left: {{Session::get('direction') === "rtl" ? '6px' : ''}};
    }
    
</style>

<div id="sidebarMain" class="d-none">
    <aside
        style="background: #ffffff!important; text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-brand-wrapper justify-content-between side-logo">
                    <!-- Logo -->
                    @php($e_commerce_logo=\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
                    <a class="navbar-brand" href="{{route('admin.dashboard.index')}}" aria-label="Front">
                        <img style="max-height: 38px"
                             onerror="this.src='{{asset('public/assets/back-end/img/900x400/img1.jpg')}}'"
                             class="navbar-brand-logo-mini for-web-logo"
                             src="{{asset("storage/app/public/company/$e_commerce_logo")}}" alt="Logo">
                    </a>
                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content mt-2">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->

                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/dashboard')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.dashboard.index')}}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{\App\CPU\translate('Dashboard')}}
                                </span>
                            </a>
                        </li>

                        <!-- End Dashboards -->
                        
                        @if(\App\CPU\Helpers::module_permission_check('order_management'))
                            
                            <!-- Order -->
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/orders*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-shopping-cart-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{\App\CPU\translate('orders')}}
                                </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/order*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/orders/list/all')?'active':''}}">
                                        <a class="nav-link" href="{{route('admin.orders.list',['all'])}}" title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('All')}}
                                            <span class="badge badge-info badge-pill ml-1">
                                                {{\App\Model\Order::where('order_type','default_type')->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/pending')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['pending'])}}" title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('pending')}}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Model\Order::where('order_type','default_type')->where(['order_status'=>'pending'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/confirmed')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['confirmed'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('confirmed')}}
                                                <span class="badge badge-soft-success badge-pill ml-1">
                                                {{\App\Model\Order::where('order_type','default_type')->where(['order_status'=>'confirmed'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/processing')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['processing'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('Processing')}}
                                                <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where('order_type','default_type')->where(['order_status'=>'processing'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/out_for_delivery')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['out_for_delivery'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('out_for_delivery')}}
                                                <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where('order_type','default_type')->where(['order_status'=>'out_for_delivery'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/delivered')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['delivered'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('delivered')}}
                                                <span class="badge badge-success badge-pill ml-1">
                                                    {{\App\Model\Order::where('order_type','default_type')->where(['order_status'=>'delivered'])->count()}}
                                                </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/returned')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['returned'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('returned')}}
                                                <span class="badge badge-soft-danger badge-pill ml-1">
                                                {{\App\Model\Order::where('order_type','default_type')->where(['order_status'=>'returned'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/failed')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['failed'])}}" title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('failed')}}
                                            <span class="badge badge-danger badge-pill ml-1">
                                                {{\App\Model\Order::where('order_type','default_type')->where(['order_status'=>'failed'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/orders/list/canceled')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['canceled'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{\App\CPU\translate('canceled')}}
                                                <span class="badge badge-danger badge-pill ml-1">
                                                {{\App\Model\Order::where('order_type','default_type')->where(['order_status'=>'canceled'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    <!--order management ends-->

                        @if(\App\CPU\Helpers::module_permission_check('product_management'))
                           
                            <!-- Pages -->
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/brand*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-apple-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{\App\CPU\translate('brands')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/brand*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/brand/add-new')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.brand.add-new')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\CPU\translate('add_new')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/brand/list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.brand.list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\CPU\translate('List')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{(Request::is('admin/category*') ||Request::is('admin/sub*')) ?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-filter-list nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{\App\CPU\translate('categories')}}
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{(Request::is('admin/category*') ||Request::is('admin/sub*'))?'block':''}}">
                                    <li class="nav-item {{Request::is('admin/category/view')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.category.view')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\CPU\translate('category')}}</span>
                                        </a>

                                    </li>
                                    <li class="nav-item {{Request::is('admin/sub-category/view')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.sub-category.view')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\CPU\translate('sub_category')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/sub-sub-category/view')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.sub-sub-category.view')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{\App\CPU\translate('sub_sub_category')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                           
                            <li class="navbar-vertical-aside-has-menu {{(Request::is('admin/product/list/in_house') || Request::is('admin/product/bulk-import'))?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-shop nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <span class="text-truncate">{{\App\CPU\translate('InHouse Products')}}</span>
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{(Request::is('admin/product/list/in_house') || Request::is('admin/product/stock-limit-list/in_house') || Request::is('admin/product/bulk-import'))?'block':''}}">
                                    <li class="nav-item {{Request::is('admin/product/list/in_house')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.product.list',['in_house', ''])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\CPU\translate('Products')}}</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/product/list/seller*')||Request::is('admin/product/updated-product-list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-airdrop nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{\App\CPU\translate('Seller')}} {{\App\CPU\translate('Products')}}
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/product/list/seller*')||Request::is('admin/product/updated-product-list')?'block':''}}">

                                    @if (\App\CPU\Helpers::get_business_settings('product_wise_shipping_cost_approval')==1)
                                    <li class="nav-item {{Request::is('admin/product/updated-product-list')?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.product.updated-product-list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{\App\CPU\translate('updated_products')}} </span>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="nav-item {{str_contains(url()->current().'?status='.request()->get('status'),'/admin/product/list/seller?status=0')==1?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.product.list',['seller', 'status'=>'0'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{\App\CPU\translate('New')}} {{\App\CPU\translate('Products')}} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{str_contains(url()->current().'?status='.request()->get('status'),'/admin/product/list/seller?status=1')==1?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.product.list',['seller', 'status'=>'1'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{\App\CPU\translate('Approved')}} {{\App\CPU\translate('Products')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{str_contains(url()->current().'?status='.request()->get('status'),'/admin/product/list/seller?status=2')==1?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.product.list',['seller', 'status'=>'2'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{\App\CPU\translate('Denied')}} {{\App\CPU\translate('Products')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    <!--product management ends-->

                        @if(\App\CPU\Helpers::module_permission_check('marketing_section'))
                            
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/banner*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.banner.list')}}">
                                    <i class="tio-photo-square-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{\App\CPU\translate('banners')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/coupon*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.coupon.add-new')}}">
                                    <i class="tio-credit-cards nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{\App\CPU\translate('coupons')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/notification*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.notification.add-new')}}" title="">
                                    <i class="tio-notifications-on-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{\App\CPU\translate('push_notification')}}
                                    </span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/deal/flash')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.deal.flash')}}">
                                    <i class="tio-flash nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{\App\CPU\translate('flash_deals')}}</span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/deal/day')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.deal.day')}}">
                                    <i class="tio-crown-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{\App\CPU\translate('deal_of_the_day')}}
                                    </span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/deal/feature')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.deal.feature')}}">
                                    <i class="tio-flag-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{\App\CPU\translate('featured_deal')}}
                                    </span>
                                </a>
                            </li>
                        @endif
                    <!--marketing section ends here-->

                        @if(\App\CPU\Helpers::module_permission_check('business_section'))
                          
                            {{-- seller withdraw --}}
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/stock/product-stock')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.stock.product-stock')}}">
                                    <i class="tio-fullscreen-1-1 nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                 {{\App\CPU\translate('product')}} {{\App\CPU\translate('stock')}}
                                </span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/reviews*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.reviews.list')}}">
                                    <i class="tio-star nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{\App\CPU\translate('Customer')}} {{\App\CPU\translate('Reviews')}}
                                </span>
                                </a>
                            </li>
                           
                          
                        @endif
                    <!--business section ends here-->

                        @if(\App\CPU\Helpers::module_permission_check('user_section'))
                            
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/seller*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-users-switch nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{\App\CPU\translate('Seller')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/seller*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/sellers/seller-add')?'active':''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.sellers.seller-add')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                                {{\App\CPU\translate('add_new_seller')}}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/sellers/seller-list')?'active':''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.sellers.seller-list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                                {{\App\CPU\translate('list')}}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/sellers/withdraw_list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.sellers.withdraw_list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\CPU\translate('withdraws')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                                </ul>
                            </li>

                        @endif
                    <!--user section ends here-->

                        

                        @if(\App\CPU\Helpers::module_permission_check('business_settings'))
                           
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/business-settings/refund*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-receipt-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{\App\CPU\translate('refund_request_list')}}
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/business-settings/refund*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/business-settings/refund/list/pending')?'active':''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.business-settings.refund.list',['pending'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                              {{\App\CPU\translate('pending')}}
                                                <span class="badge badge-soft-danger badge-pill ml-1">
                                                    {{\App\Model\RefundRequest::where('status','pending')->count()}}
                                                </span>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/business-settings/refund/list/approved')?'active':''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.business-settings.refund.list',['approved'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                               {{\App\CPU\translate('approved')}}
                                                <span class="badge badge-soft-info badge-pill ml-1">
                                                    {{\App\Model\RefundRequest::where('status','approved')->count()}}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/refund/list/refunded')?'active':''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.business-settings.refund.list',['refunded'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                               {{\App\CPU\translate('refunded')}}
                                                <span class="badge badge-success badge-pill ml-1">
                                                    {{\App\Model\RefundRequest::where('status','refunded')->count()}}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/refund/list/rejected')?'active':''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.business-settings.refund.list',['rejected'])}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                               {{\App\CPU\translate('rejected')}}
                                                <span class="badge badge-danger badge-pill ml-1">
                                                    {{\App\Model\RefundRequest::where('status','rejected')->count()}}
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                          
                        @endif
                    <!--business settings ends here-->



                        @if(\App\CPU\Helpers::module_permission_check('delivery_man_management'))
                            

                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/delivery-man*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-user nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{\App\CPU\translate('delivery-man')}}
                                        </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/delivery-man*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/delivery-man/add')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.delivery-man.add')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\CPU\translate('add_new')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/delivery-man/list')?'active':''}}">
                                        <a class="nav-link" href="{{route('admin.delivery-man.list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{\App\CPU\translate('List')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>



