<div class="section small_pt pb_70">
    <div class="container">

        <div class="row shop_container" id="byBrandProducts">

           

        </div>
    </div>
</div>


<script>
    // console.log(searchParams.get('id'));
    async function catProducts() {
        const searchParams = new URLSearchParams(window.location.search);
        const brandID = searchParams.get('id');
        const res = await axios.get(`/ListProductByBrand/${brandID}`, );
        $('#byBrandProducts').empty();

        if (res.length == 0) {
            $('#byBrandProducts').append('Data Now Found!');
        } else {            
            res?.data?.data?.forEach((item, index) => {
                let priceHTML = '';
                if (item.discount_price > 0) {
                    priceHTML = `
                        <div class="product_price">
                            <span class="price">${item.discount_price}</span>
                            <del>${item.price}</del>
                            <div class="on_sale">
                                <span>${item.discount}% Off</span>
                            </div>
                        </div>
                        `
                } else {
                    priceHTML = `
                       <div class="product_price">
                            <span class="price">${item.price}</span>
                        </div>
                        `
                }

                let EachItem = `
               <div class="col-lg-3 col-md-4 col-6">
                <div class="product">
                    <div class="product_img">
                        <a href="#">
                            <img src="${item.image }" alt="${item.title}">
                        </a>
                        <div class="product_action_box">
                            <ul class="list_none pr_action_btn">
                                <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                                <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                <li><a href="#"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product_info">
                        <h6 class="product_title"><a href="#">${item.title}</a></h6>
                      ${priceHTML}
                        <div class="rating_wrap">
                            <div class="rating">
                                <div class="product_rate" style="width:${item.star}%"></div>
                            </div>
                            <span class="rating_num">(21)</span>
                        </div>
                        <div class="pr_desc">
                            <p>${item.short_des}</p>
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
            `;

                $('#byBrandProducts').append(EachItem);
            });
        }
    }
    catProducts()
</script>