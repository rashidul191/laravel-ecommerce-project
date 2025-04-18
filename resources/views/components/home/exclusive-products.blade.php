<!-- START SECTION SHOP -->
<div class="section small_pt pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>Exclusive Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-style1">

                    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                        <?php $i = 1; ?>
                        @foreach ( $productTabs as $productTab )
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $i == 1 ? 'active' : '' }}" id="{{ $productTab->remark }}-tab" data-bs-toggle="pill" data-bs-target="#{{ $productTab->remark }}" type="button" role="tab" aria-controls="{{ $productTab->remark }}" aria-selected="true">{{ $productTab->remark }}</button>
                        </li>

                        <?php $i++; ?>
                        @endforeach
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                        </li> -->
                    </ul>

                </div>

                <div class="tab-content" id="pills-tabContent">
                    <?php $i = 1; ?>
                    @foreach ( $productTabs as $productTab )
                    <div class="tab-pane fade {{ $i == 1 ? 'show active' : '' }} " id="{{ $productTab->remark }}" role="tabpanel" aria-labelledby="{{ $productTab->remark }}-tab">

                        <div class="row ">

                            @foreach ( $productQueries as $productQuery )
                            @if($productTab->remark == $productQuery->remark)
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="{{ route('ProductDetails', ['id'=>$productQuery->id]) }}">
                                            <img src="{{ $productQuery->image }}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                <li><a href="shop-compare.html" ><i class="icon-shuffle"></i></a></li>
                                                <li><a href="{{ route('ProductDetails', ['id'=>$productQuery->id]) }}" ><i class="icon-magnifier-add"></i></a></li>
                                                <li><a href="#"><i class="icon-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="{{ route('ProductDetails', ['id'=>$productQuery->id]) }}">{{ $productQuery->title }}</a></h6>
                                        <div class="product_price">
                                            @if($productQuery->discount_price > 0)
                                            <span class="price"> TK {{ $productQuery->discount_price }}</span>
                                            <del>TK {{ $productQuery->price }}</del>
                                            <div class="on_sale">
                                                <span>{{ $productQuery->discount }}% Off</span>
                                            </div>
                                            @else
                                            <span class="price"> TK {{ $productQuery->price }}</span>
                                            @endif

                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">

                                                <div class="product_rate" style="width:<?php echo $productQuery->star ?>%"></div>
                                            </div>
                                            <span class="rating_num">(21)</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>{{ $productQuery->short_des }}</p>
                                        </div>
                                        <div class="pr_switch_wrap">
                                            <div class="product_color_switch">
                                                <span class="active" data-color="#87554B"></span>
                                                <span data-color="#333333"></span>
                                                <span data-color="#DA323F"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>
                    </div>

                    <?php $i++; ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->