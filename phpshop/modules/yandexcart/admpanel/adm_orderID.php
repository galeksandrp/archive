<?php

include_once dirname(__DIR__) . '/class/YandexMarket.php';

function yandexcartChangeStatus($data)
{
    $yandex = new YandexMarket();

    if($yandex->options['model'] === 'DBS') {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);

        $order = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_POST['rowID'])));

        if((int) $order['statusi'] !== (int) $_POST['statusi_new']) {
            $options = unserialize($yandex->options['options']);

            isset($options['statuses']) && is_array($options['statuses']) ? $statuses = $options['statuses'] : $statuses = array();

            foreach ($statuses as $statusYandex => $statusSite) {

                if((int) $statusSite === (int) $_POST['statusi_new']) {

                    // Status DELIVERY
                    if($statusYandex === 'delivery') {
                        $yandex->changeStatus($order['yandex_order_id'], array('order' => array('status' => 'DELIVERY')));
                    }

                    // Status PICKUP
                    if($statusYandex === 'pickup') {
                        $yandex->changeStatus($order['yandex_order_id'], array('order' => array('status' => 'PICKUP')));
                    }

                    // Status DELIVERED
                    if($statusYandex === 'delivered') {
                        $yandex->changeStatus($order['yandex_order_id'], array('order' => array('status' => 'DELIVERED')));
                    }

                    // Status CANCELLED
                    if($statusYandex === 'cancelled_shop_failed' or $statusYandex === 'cancelled_replacing_order' or $statusYandex === 'cancelled_user_changed_mind') {
                        $substatus = 'SHOP_FAILED';
                        if($statusYandex === 'cancelled_replacing_order') {
                            $substatus = 'REPLACING_ORDER';
                        }
                        if($statusYandex === 'cancelled_user_changed_mind') {
                            $substatus = 'USER_CHANGED_MIND';
                        }

                        $yandex->changeStatus(
                            $order['yandex_order_id'],
                            array('order' => array('status' => 'CANCELLED', 'substatus' => $substatus))
                        );
                    }
                }
            }
        }
    }
}

$addHandler=array(
    'actionStart'=>false,
    'actionDelete'=>false,
    'actionUpdate'=>'yandexcartChangeStatus',
    'actionSave'=>false
);