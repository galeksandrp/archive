
<div class="col-xs-12 product-block-wrapper product-col-1">
    <div class="product-block">
        <div class="product-block-top">
            
            <div class="product-block-img">
                <a class="product-block-img-link" href="/shop/UID_@productUid@.html" title="@productName@"><img data-src="@productImg@" class="image-fix owl-lazy" alt="@productName@"></a>
            </div>
        </div>
        <div class="product-block-bottom">
            <h3 class="product-block-name product-name-fix">
                <a href="/shop/UID_@productUid@.html" title="@productName@">@productName@</a>
            </h3>
            <h4 class="product-block-price">
                <span class="price-new">@productPrice@<span class="rubznak">@productValutaName@</span></span><span class="price-old">@productPriceOld@</span>
            </h4>
            <div class="stock">
@ComStartNotice@
<div class="outStock">@productOutStock@</div>
@ComEndNotice@
<span class="product-sklad-list-block">@productSklad@</span>
</div>
            <span class="sale-icon-content">
                @specIcon@
                @newtipIcon@
                @hitIcon@
               @promotionsIcon@ </span>
           
            <div class="prodict-block-description">
                @productDes@
            </div>
            @previewSorts@
            <div class="product-block-button-col-1">
            <a class="btn btn-cart @elementCartOptionHide@" href="/shop/UID_@productUid@.html"  data-title="@productSale@" >
            <i class="icons-cart"></i>
            </a>
            <button type="button" class="btn btn-cart addToCartList @elementCartHide@" role="button" data-num="1" data-uid="@productUid@" data-cart="@productSaleReady@" data-title="@productSale@" >
                <i class="icons-cart"></i>
            </button>
            <a href="#" data-role="/shop/UID_@productUid@.html" class="btn btn-cart fastView" data-toggle="modal" data-target="#modalProductView" ><i class="icons-view"></i></a>
            <button class="btn btn-wishlist addToWishList" role="button" data-uid="@productUid@" data-title="{��������}" data-placement="top" data-toggle="tooltip"><i class="icons-wishlist"></i></button>
            <button class="btn btn-wishlist addToCompareList" role="button" data-uid="@productUid@" data-title="{��������}" data-placement="top" data-toggle="tooltip"><i class="icons-compare"></i></button>

            <a class="btn btn-cart @elementNoticeHide@" href="/users/notice.html?productId=@productUid@" title="@productNotice@"  data-title="@productNotice@" data-placement="top" data-toggle="tooltip">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>                            
            </a>                             
            </div>
        </div>
    </div>
</div>