
<div class="col-xs-12 product-block-wrapper product-col-1">
    <div class="product-block">
        <div class="product-block-top">
            <div class="product-block-image">
                <div class="sale-icon-content">
                    @specIcon@
			@newtipIcon@
			@hitIcon@
			@promotionsIcon@
                </div>
                <a class="product-block-img-link" href="/shop/UID_@productUid@.html" title="@productName@"><img data-src="@productImg@" alt="@productName@" class="owl-lazy"></a>
            </div>
        </div>
        <div class="product-block-bottom">
            <h3 class="product-block-name product-name-fix">
                <a href="/shop/UID_@productUid@.html" title="@productName@">@productName@</a>
            </h3>
            <h4 class="product-block-price">
                <span class="price-old">@productPriceOld@</span>
                <span class="price-new">@productPrice@ <span class="rubznak">@productValutaName@</span></span>
            </h4>

            <span class="product-sklad-list-block">@productSklad@
			            @ComStartNotice@
<div �lass="outStock text-left">@productOutStock@</div>
@ComEndNotice@
			</span>
			<br>
            <div class="product-block-description">
                @productDes@
            </div>
            @previewSorts@
            <div class="product-block-button">
                <button class="btn btn-wishlist addToCompareList hidden-md" role="button" data-uid="@productUid@" data-title="{��������}" data-placement="top" data-toggle="tooltip"><i class="fa fa-bar-chart-o"></i></button>
                <button class="btn btn-wishlist addToWishList" role="button" data-uid="@productUid@" data-title="{��������}" data-placement="top" data-toggle="tooltip"><i class="feather iconz-heart"></i></button>
                <a class="btn btn-cart @elementCartOptionHide@" href="/shop/UID_@productUid@.html">
                    <span>@productSale@</span>
                </a>
                <button type="button" class="btn btn-cart addToCartList @elementCartHide@" role="button" data-num="1" data-uid="@productUid@" data-cart="@productSaleReady@">              
                    <span>@productSale@</span>
                </button>
                <a class="btn btn-cart @elementNoticeHide@" href="/users/notice.html?productId=@productUid@" title="@productNotice@">
                    {���������}
                </a>
            </div>
        </div>
    </div>
</div>