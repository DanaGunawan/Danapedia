@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
<style type="text/css">
    .active-color {
        border: 3px solid #000 !important;
    }
</style>
@endsection



@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: {{url('assets/images/page-header-bg.jpg')}}">
        <div class="container">
            @if (!empty($getSubCategory))
                <h1 class="page-title">{{ $getSubCategory->name }} </h1>
            @else

                <h1 class="page-title">{{ $getCategory->name }} </h1>
            @endif

        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                @if (!empty($getSubCategory))
                    <li class="breadcrumb-item"><a href="{{ url($getCategory->slug) }}"> {{ $getCategory->name }} </a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="javascript:;">{{ $getSubCategory->name }} </a></li>
                @else 

                    <li class="breadcrumb-item active" aria-current="page"><a href="javascript:;">{{ $getCategory->name }}
                        </a></li>

                @endif

            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>9 of 56</span> Products
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control ChangeSortBy">
                                        <option value="">select</option>
                                        <option value="popularity" selected="selected">Most Popular</option>
                                        <option value="rating">Most Rated</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->


                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row justify-content-center">



                            @foreach ($product_data as $product)
                                                        @php
                                                            $get_image_single = $product::getSingleImage($product->id);
                                                        @endphp
                                                        <div class="col-12 col-md-4 col-lg-4">
                                                            <div class="product product-7 text-center">
                                                                <figure class="product-media">
                                                                    <span class="product-label label-new">New</span>

                                                                    @if(!empty($get_image_single->image_name) && !empty($get_image_single->imageUrl()))
                                                                        <img src="{{ $get_image_single->imageUrl() }}"
                                                                            style="width:280px; height:280px; object-fit:cover;" alt="Product image"
                                                                            class="product-image">
                                                                        </a>
                                                                    @endif
                                                                    <div class="product-action-vertical">
                                                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                                                                to wishlist</span></a>
                                                                    </div>
                                                                </figure>

                                                                <div class="product-body">
                                                                    <div class="product-cat">
                                                                        <a href="{{ url($product->category_slug . '/' . '') }}">
                                                                            {{ $product->category_name }}
                                                                        </a>
                                                                        <br>
                                                                        <a
                                                                            href="{{ url($product->category_slug . '/' . $product->sub_category_slug) }}">
                                                                            {{ $product->sub_category_name }}
                                                                        </a>
                                                                    </div>
                                                                    <h3 class="product-title"><a
                                                                            href="{{ url($product->slug) }}">{{ $product->title }}</a></h3>
                                                                    <div class="product-price">
                                                                        Rp {{ number_format($product->price, 2) }}
                                                                    </div>
                                                                    <div class="ratings-container">
                                                                        <div class="ratings">
                                                                            <div class="ratings-val" style="width: 20%;"></div>
                                                                        </div>
                                                                        <span class="ratings-text">( 2 Reviews )</span>
                                                                    </div>

                                                                    <div class="product-nav product-nav-thumbs">
                                                                        <a href="#" class="active">
                                                                            <img src="{{ url('')}}/assets/images/products/product-4-thumb.jpg"
                                                                                alt="product desc">
                                                                        </a>
                                                                        <a href="#">
                                                                            <img src="{{ url('')}}/assets/images/products/product-4-2-thumb.jpg"
                                                                                alt="product desc">
                                                                        </a>

                                                                        <a href="#">
                                                                            <img src="{{ url('')}}/assets/images/products/product-4-3-thumb.jpg"
                                                                                alt="product desc">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                            @endforeach


                        </div><!-- End .row -->
                    </div><!-- End .products -->

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            {!! $product_data->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                        </ul>
                    </nav>
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <form action="" method="post" class="filterForm" id="FilterForm">
                        @csrf
                        <input type="text" name="ajax_sub_category_id" id="get_sub_category_id">
                        <input type="text" name="ajax_brand_id" id="get_brand_id">
                        <input type="text" name="ajax_color_id" id="get_color_id">
                        <input type="text" name="ajax_sort_id" id="get_sort_by_id">
                    </form>
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="#" class="sidebar-filter-clear">Clean All</a>
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                    aria-controls="widget-1">
                                    {{ $getCategory->name }}
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count ">
                                        @foreach ($sub_category_filter as $subCategoryFilter)
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ChangeCategory"
                                                        value="{{ $subCategoryFilter->id }}"
                                                        id="cat-{{ $subCategoryFilter->id }}">
                                                    <label class="custom-control-label"
                                                        for="cat-{{ $subCategoryFilter->id }}">{{ $subCategoryFilter->name }}</label>
                                                </div>
                                                <span class="item-count">{{ $subCategoryFilter->CountProduct() }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"
                                aria-controls="widget-2">
                                Size
                            </a>
                        </h3>

                        <div class="collapse show" id="widget-2">
                            <div class="widget-body">
                                <div class="filter-items">
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="size-1">
                                            <label class="custom-control-label" for="size-1">XS</label>
                                        </div>
                                    </div>

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="size-2">
                                            <label class="custom-control-label" for="size-2">S</label>
                                        </div>
                                    </div>

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked id="size-3">
                                            <label class="custom-control-label" for="size-3">M</label>
                                        </div>
                                    </div>

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked id="size-4">
                                            <label class="custom-control-label" for="size-4">L</label>
                                        </div>

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-5">
                                                <label class="custom-control-label" for="size-5">XL</label>
                                            </div>
                                        </div>

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-6">
                                                <label class="custom-control-label" for="size-6">XXL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true"
                                    aria-controls="widget-3">
                                    Colour
                                </a>
                            </h3>

                            <div class="collapse show" id="widget-3">
                                <div class="widget-body">
                                    <div class="filter-colors">
                                        @foreach ($getColor as $color_f)
                                            <a href="javascript:;" class="ChangeColor" id="{{ $color_f->id }}" data-val="0"
                                                style="background: {{ $color_f->code }};"><span class="sr-only">
                                                    {{ $color_f->name }}</span></a>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                    aria-controls="widget-4">
                                    Brand
                                </a>
                            </h3>


                            <div class="collapse show" id="widget-4">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        @foreach ($getBrands as $brand_f)
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ChangeBrands"
                                                        id="brand-{{ $brand_f->id }}" value="{{ $brand_f->id }}">
                                                    <label class="custom-control-label"
                                                        for="brand-{{ $brand_f->id }}">{{ $brand_f->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach



                                        <div class="widget widget-collapsible">
                                            <h3 class="widget-title">
                                                <a data-toggle="collapse" href="#widget-5" role="button"
                                                    aria-expanded="true" aria-controls="widget-5">
                                                    Price
                                                </a>
                                            </h3>

                                            <div class="collapse show" id="widget-5">
                                                <div class="widget-body">
                                                    <div class="filter-price">
                                                        <div class="filter-price-text">
                                                            Price Range:
                                                            <span id="filter-price-range"></span>
                                                        </div>

                                                        <div id="price-slider"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                </aside>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
<script src="{{ url('assets/js/nouislider.min.js') }}"></script>
<script src="{{ url('assets/js/wNumb.js') }}"></script>
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>

<script type="text/javascript">

    $(".ChangeSortBy").change(function () {
        let id = $(this).val();
        console.log(id);

        $("#get_sort_by_id").val(id);
        FilterForm();

    })



    $('.ChangeCategory').change(function () {
        let ids = '';
        $('.ChangeCategory').each(function () {
            if (this.checked) {
                let id = $(this).val();
                ids += id + ',';
            }
        })
        $('#get_sub_category_id').val(ids);
        FilterForm();
    });

    $('.ChangeBrands').change(function () {
        let ids = '';
        $('.ChangeBrands').each(function () {
            if (this.checked) {
                let id = $(this).val();
                ids += id + ',';
               
            }
        })
        $('#get_brand_id').val(ids);
        FilterForm();
    });

    $('.ChangeColor').click(function () {
        let id = $(this).attr('id');
        let status = $(this).attr('data-val');

        if (status == 0) {
            $(this).attr('data-val', 1);
            $(this).addClass('active-color');
        }
        else {
            $(this).attr('data-val', 0);
            $(this).removeClass('active-color');
        }
        let ids = '';
        $('.ChangeColor').each(function () {
            status = $(this).attr('data-val');

            if (status == 1) {
                let id = $(this).attr('id');
                ids += id + ',';
            }

        })
        $('#get_color_id').val(ids);
        FilterForm();
    });

    function FilterForm(){
        $.ajax({
            type: "POST",
            data: $('#FilterForm').serialize(),
            url : "{{ url('ProductFilteringAjax') }}",
            dataType: "json",
            success: function (data) {

            },
            error: function (data){
                console.log("Error" + data);
            }
            
        });
    }

</script>

@endsection