<?php

session_start();

$_classPath = "../../../";
include_once($_classPath . "class/obj.class.php");
include_once($_classPath . "modules/ozonrocket/class/OzonRocketWidget.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
PHPShopObj::loadClass('modules');
PHPShopObj::loadClass('orm');
PHPShopObj::loadClass('system');
PHPShopObj::loadClass('security');
PHPShopObj::loadClass('order');

$PHPShopBase->chekAdmin();

$OzonRocketWidget = new OzonRocketWidget();

if (isset($_REQUEST['operation']) && strlen($_REQUEST['operation']) > 2) {
    $result = array();
    try {
        switch ($_REQUEST['operation']) {
            case 'paymentStatus':
                $order = new PHPShopOrderFunction((int)$_REQUEST['orderId']);
                if (!empty($order->objRow)) {
                    $order->changePaymentStatus((int)$_REQUEST['value']);
                }
                break;
            case 'changeAddress':
                $OzonRocketWidget->changeAddress($_REQUEST);
                break;
            case 'send':
                $order = $OzonRocketWidget->getOrderById((int)$_REQUEST['orderId']);
                $OzonRocketWidget->send($order);
                break;
        }

        $result['success'] = true;
    } catch (\Exception $exception) {
        $result = array('success' => false, 'error' => PHPShopString::win_utf8($exception->getMessage()));
    }
} else {
    $result = array('success' => false, 'error' => PHPShopString::win_utf8('�� ������ �������� operation'));
}

echo(json_encode($result));
exit;