<?php

include_once dirname(__DIR__) . '/Xml/BaseAvitoXml.php';
include_once dirname(__DIR__) . '/Xml/AvitoPriceInterface.php';

/**
 * XML ����� ����� "������� �����������"
 * @author PHPShop Software
 * @version 1.1
 */
class AvitoAppliance extends BaseAvitoXml implements AvitoPriceInterface
{
    public static function getXml($product)
    {
        $xml = '<Ad>';
        $xml .= sprintf('<Id>%s</Id>', $product['id']);
        $xml .= sprintf('<Category>%s</Category>', $product['category']);
        $xml .= sprintf('<GoodsType>%s</GoodsType>', $product['type']);
        $xml .= sprintf('<Title>%s</Title>', $product['name']);
        $xml .= sprintf('<Description>%s</Description>', $product['description']);
        $xml .= sprintf('<Price>%s</Price>', $product['price']);
        $xml .= sprintf('<AdStatus>%s</AdStatus>', $product['status']);
        $xml .= sprintf('<ListingFee>%s</ListingFee>', $product['listing_fee']);
        $xml .= sprintf('<Condition>%s</Condition>', $product['condition']);
        $xml .= sprintf('<ManagerName>%s</ManagerName>', PHPShopString::win_utf8(Avito::getOption('manager')));
        $xml .= sprintf('<ContactPhone>%s</ContactPhone>', PHPShopString::win_utf8(Avito::getOption('phone')));
        $xml .= sprintf('<Address>%s</Address>', PHPShopString::win_utf8(static::getAddress()));

        if(count($product['images']) > 0) {
            $xml .= '<Images>';
            foreach ($product['images'] as $image) {
                $xml .= sprintf('<Image url="%s"/>', $image['name']);
            }
            $xml .= '</Images>';
        }

        $xml .= '</Ad>';

        return $xml;
    }
}
?>