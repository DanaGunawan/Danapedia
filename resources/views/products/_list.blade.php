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