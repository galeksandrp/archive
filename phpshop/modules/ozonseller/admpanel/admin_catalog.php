<?php

function ozonAddCaptions()
{
    global $PHPShopInterface;

    $memory = $PHPShopInterface->getProductTableFields();

    if(isset($memory['catalog.option']['price_ozon'])) {
        $PHPShopInterface->productTableCaption[] = ["Ozon", "15%", ['view' => (int) $memory['catalog.option']['price_ozon']]];
    }
}

$addHandler = [
    'getTableCaption' => 'ozonAddCaptions'
];
