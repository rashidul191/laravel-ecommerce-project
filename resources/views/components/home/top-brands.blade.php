<!-- START SECTION Brands -->
<div class="section small_pb small_pt">
	<div class="container">
    	<div class="row justify-content-center">
			<div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>Top Brands</h2>
                </div>              
            </div>
		</div>
        <div class="row align-items-center">
            <div class="col-12">
                <div class="cat_slider cat_style1 mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "576":{"items": "4"}, "768":{"items": "5"}, "991":{"items": "6"}, "1199":{"items": "7"}}'>

               
                @foreach ( $brands as $brand )
                    <div class="item">
                        <div class="categories_box">
                            <a href="#">
                                <img src="{{ $brand->brandImg }}" alt="cat_img1"/>
                                <span>{{ $brand->brandName }}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION Brands --> 