<?php

PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("payment");
PHPShopObj::loadClass("delivery");
PHPShopObj::loadClass("user");
PHPShopObj::loadClass("text");

$TitlePage = __('�������������� ������') . ' #' . $_GET['id'];
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);

$PHPShopDelivery = new PHPShopDelivery();

$PHPShopValutaArray = new PHPShopValutaArray();

/**
 * ���������� ������
 */
function updateDiscount($data) {
    global $link_db;

    // ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $GetOrderStatusArray = $PHPShopOrderStatusArray->getArray();

    if ($GetOrderStatusArray[$_POST['statusi_new']]['cumulative_action'] == 1) {

        // ������ ������� ������������
        $sql_st = "SELECT * FROM `" . $GLOBALS['SysValue']['base']['shopusers'] . "` WHERE `id` =" . intval($data['user']) . " ";
        $query_st = mysqli_query($link_db, $sql_st);
        $row_st = mysqli_fetch_array($query_st);
        $status_user = $row_st['status'];

        //������ ��������� ������� ������������ ������
        $sql_d = "SELECT * FROM `" . $GLOBALS['SysValue']['base']['shopusers_status'] . "` WHERE `id` =" . intval($status_user) . " ";
        $query_d = mysqli_query($link_db, $sql_d);
        $row_d = mysqli_fetch_array($query_d);
        $cumulative_array = unserialize($row_d['cumulative_discount']);
        $cumulative_array_check = $row_d['cumulative_discount_check'];
        if ($cumulative_array_check == 1) {
            //������ �������
            $sql_order = "SELECT " . $GLOBALS['SysValue']['base']['orders'] . ".* FROM `" . $GLOBALS['SysValue']['base']['orders'] . "`
            LEFT JOIN `" . $GLOBALS['SysValue']['base']['order_status'] . "` ON " . $GLOBALS['SysValue']['base']['orders'] . ".statusi=" . $GLOBALS['SysValue']['base']['order_status'] . ".id
            WHERE " . $GLOBALS['SysValue']['base']['orders'] . ".user =  " . $data['user'] . "
            AND " . $GLOBALS['SysValue']['base']['order_status'] . ".cumulative_action='1' ";
            $query_order = mysqli_query($link_db, $sql_order);
            $row_order = mysqli_fetch_array($query_order);
            $sum = '0'; //������� �����
            do {
                $orders = unserialize($row_order['orders']);
                $sum += $orders['Cart']['sum'];
            } while ($row_order = mysqli_fetch_array($query_order));

            //������ ������
            $q_cumulative_discount = '0'; //������� ������
            foreach ($cumulative_array as $key => $value) {
                if ($sum >= $value['cumulative_sum_ot'] and $sum <= $value['cumulative_sum_do']) {
                    $q_cumulative_discount = $value['cumulative_discount'];
                    break;
                }
            }
            //��������� ������
            mysqli_query($link_db, "UPDATE  `" . $GLOBALS['SysValue']['base']['shopusers'] . "` SET `cumulative_discount` =  '" . $q_cumulative_discount . "' WHERE `id` =" . intval($data['user']));
        } else {
            mysqli_query($link_db, "UPDATE  `" . $GLOBALS['SysValue']['base']['shopusers'] . "` SET `cumulative_discount` =  '0' WHERE `id` =" . intval($data['user']));
        }
    }
}

/**
 * ���������� �� ������
 */
function updateStore($data) {
    global $PHPShopSystem, $PHPShopBase, $_classPath;

    // ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $GetOrderStatusArray = $PHPShopOrderStatusArray->getArray();


    // SMS ���������� ������������ � ����� ������� ������
    if ($data['statusi'] != $_POST['statusi_new'] and $PHPShopSystem->ifSerilizeParam('admoption.sms_status_order_enabled')) {

        $phone = $_POST['tel_new'];
        $msg = strtoupper($_SERVER['SERVER_NAME']) . ': ' . $PHPShopBase->getParam('lang.sms_user') . $data['uid'] . " - " . $GetOrderStatusArray[$_POST['statusi_new']]['name'];

        // �������� �� ������ 7 ��� 8
        $first_d = substr($phone, 0, 1);
        if ($first_d != 8)
            $phone = '7' . $phone;
        $phone = str_replace(array('(', ')', '-'), '', $phone);

        $lib = str_replace('./phpshop/', $_classPath, $PHPShopBase->getParam('file.sms'));
        include_once $lib;
        SendSMS($msg, $phone);
    }


    // ���� ����� ������ �����������, � ��� ������ �� ����� �����, �� �� �� ���������, � ��������� �������
    if ($data['statusi'] != 0 && $_POST['statusi_new'] == 1) {
        if (is_array($data)) {
            $order = unserialize($data['orders']);
            if (is_array($order['Cart']['cart']))
                foreach ($order['Cart']['cart'] as $val) {

                    // ������ �� ������
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                    $product_row = $PHPShopOrm->select(array('items'), array('id' => '=' . intval($val['id'])), false, array('limit' => 1));
                    if (is_array($product_row)) {

                        // �����
                        $product_update['items_new'] = $product_row['items'] + $val['num'];
                        $product_update['sklad_new'] = 0;
                        $product_update['enabled_new'] = 1;

                        // ��������� ������
                        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                        $PHPShopOrm->debug = false;
                        $PHPShopOrm->update($product_update, array('id' => '=' . $val['id']));
                    }
                }
        }
    } else if ($GetOrderStatusArray[$_POST['statusi_new']]['sklad_action'] == 1 and $GetOrderStatusArray[$data['statusi']]['sklad_action'] != 1) {
        if (is_array($data)) {
            $order = unserialize($data['orders']);
            if (is_array($order['Cart']['cart']))
                foreach ($order['Cart']['cart'] as $val) {

                    // ������ �� ������
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                    $product_row = $PHPShopOrm->select(array('items'), array('id' => '=' . intval($val['id'])), false, array('limit' => 1));
                    if (is_array($product_row)) {

                        // �����
                        $product_update['items_new'] = $product_row['items'] - $val['num'];

                        // ���������� �� ������
                        switch ($PHPShopSystem->getSerilizeParam('admoption.sklad_status')) {

                            case(3):
                                if ($product_update['items_new'] < 1) {
                                    $product_update['sklad_new'] = 1;
                                    $product_update['enabled_new'] = 1;
                                } else {
                                    $product_update['sklad_new'] = 0;
                                    $product_update['enabled_new'] = 1;
                                }
                                break;

                            case(2):
                                if ($product_update['items_new'] < 1) {
                                    $product_update['enabled_new'] = 0;
                                    $product_update['sklad_new'] = 0;
                                } else {
                                    $product_update['enabled_new'] = 1;
                                    $product_update['sklad_new'] = 0;
                                }
                                break;

                            default:
                                break;
                        }

                        // ��������� ������
                        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                        $PHPShopOrm->debug = false;
                        $PHPShopOrm->update($product_update, array('id' => '=' . intval($val['id'])));
                    }
                }
        }
    }
}

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem;
    
    // �������
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['id'])), false, array('limit' => 1));

    $PHPShopGUI->addJSFiles('./js/jquery.suggestions.min.js', './order/gui/order.gui.js', './order/gui/dadata.gui.js');
    if (strlen($data['street']) > 5)
        $PHPShopGUI->addJSFiles('//api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU');

    $PHPShopGUI->addCSSFiles('./css/suggestions.min.css');

    $PHPShopGUI->action_select['��� ������ ������������'] = array(
        'name' => '��� ������ ������������',
        'action' => 'order-list',
        'url' => '?path=' . $_GET['path'] . '&where[a.user]=' . $data['user']
    );

    $PHPShopGUI->action_select['����� �� �������'] = array(
        'name' => '����� �� �������',
        'action' => 'order-list',
        'url' => '?path=report.statorder&where[a.user]=' . $data['user'] . '&date_start=01-01-2010&date_end=' . PHPShopDate::get()
    );

    $PHPShopGUI->action_select['csv'] = array(
        'name' => '������� � CSV',
        'action' => 'order-list',
        'url' => './order/export/csv.php?id=' . $data['id'],
        'target' => '_blank'
    );

    $PHPShopGUI->action_select['xml'] = array(
        'name' => '������� � CommerceML',
        'action' => 'order-list',
        'url' => './order/export/xml.php?id=' . $data['id'],
        'target' => '_blank'
    );

    // ���������� ������
    $PHPShopOrder = new PHPShopOrderFunction($data['id'], $data);

    $update_date = $PHPShopOrder->getStatusTime();
    if (!empty($update_date))
        $update_date = ' / ' . __('�������') . ': ' . $update_date;

    // ���� �����
    if ($PHPShopOrder->default_valuta_iso == 'RUB' or $PHPShopOrder->default_valuta_iso == 'RUR')
        $currency = ' <span class=rubznak>p</span>';
    else
        $currency = $PHPShopOrder->default_valuta_iso;

    $PHPShopGUI->setActionPanel(__("�����") . ' � ' . $data['uid'] . ' <span class="hidden-xs hidden-md">/ ' . PHPShopDate::dataV($data['datas']) . $update_date . ' / ' . __("�����") . ': ' . $PHPShopOrder->getTotal(false, ' ') . $currency . '</span>', array('������� �����', '��� ������ ������������', '����� �� �������', '|', 'csv', 'xml', '|', '�������'), array('���������', '��������� � �������'), false);

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    $order = unserialize($data['orders']);
    $status = unserialize($data['status']);

    $house = $porch = $flat = null;
    if (!empty($data['house']))
        $house = ', �. ' . $data['house'];

    if (!empty($data['porch']))
        $porch = ', ���. ' . $data['porch'];

    if (!empty($data['flat']))
        $flat = ', ��. ' . $data['flat'];
    
    if (empty($data['fio']) and !empty($order['Person']['name_person']))
        $data['fio'] = $order['Person']['name_person'];

    // ���������� � ����������
    $sidebarleft[] = array('id' => 'user-data-1', 'title' => '���������� � ����������', 'name' => array('caption' => $data['fio'], 'link' => '?path=shopusers&return=order.' . $data['id'] . '&id=' . $data['user']), 'content' => array(array('caption' => $order['Person']['mail'], 'link' => 'mailto:' . $order['Person']['mail']), $data['tel']));

    // ����� ��������
    $sidebarleft[] = array('id' => 'user-data-2', 'title' => '����� ��������', 'name' => $data['fio'], 'content' => array($data['tel'], $data['street'] . $house . $porch . $flat));

    // �����
    if ($PHPShopSystem->ifSerilizeParam('admoption.yandexmap_enabled')) {
        if (strlen($data['street']) > 5) {
            $map = '<div id="map" class="visible-lg" data-geocode="' . $data['city'] . ', ' . $data['street'] . ' ' . $data['house'] . '" data-title="'.__('�����').' �' . $data['uid'] . '"></div><div class="data-row"><a href="http://maps.yandex.ru/?&source=wizgeo&text=' . urlencode(PHPShopString::win_utf8($data['city'] . ', ' . $data['street'] . ' ' . $data['house'])) . '" target="_blank" class="text-muted"><span class="glyphicon glyphicon-map-marker"></span>'.__('��������� �����').'</a></div>';
            $sidebarleft[] = array('title' => '����� �������� �� �����', 'content' => array($map));
        }
    }

    // ����� �������
    $PHPShopGUI->setSidebarLeft($sidebarleft, 2, true);

    // ������� �������
    PHPShopObj::loadClass('order');

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $data['statusi'], 'data-content="<span class=\'glyphicon glyphicon-text-background\' style=\'color:#35A6E8\'></span> ' . __('����� �����') . '"');
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $k => $order_status) {
            $order_status_value[] = array($order_status['name'], $order_status['id'], $data['statusi'], 'data-content="<span class=\'glyphicon glyphicon-text-background\' style=\'color:' . $order_status['color'] . '\'></span> ' . $order_status['name'] . '"');
        }

    // ������ ������
    $status_dropdown = $PHPShopGUI->setSelect('statusi_new', $order_status_value, 180);
    $sidebarright[] = array('title' => '������ ������', 'content' => $status_dropdown);

    // ����� ��������� ������
    if (empty($status['time']))
        $status['time'] = PHPShopDate::dataV($data['datas'], true, false, ' ', true);

    // �������� ���� �����
    $PHPShopPaymentArray = new PHPShopPaymentArray();
    $PaymentArray = $PHPShopPaymentArray->getArray();
    if (is_array($PaymentArray))
        foreach ($PaymentArray as $payment) {

            // ������� ������������
            if (strpos($payment['name'], '.')) {
                $name = explode(".", $payment['name']);
                $payment['name'] = $name[0];
            }

            $payment_value[] = array($payment['name'], $payment['id'], $order['Person']['order_metod']);
        }

    // ��� ������
    $payment_dropdown = $PHPShopGUI->setSelect('person[order_metod]', $payment_value, 180);

    // ���������� �� ������
    $sidebarright[] = array('title' => '���������� �� ������', 'content' => $payment_dropdown);

    // �������� ������
    $Tab_print = $PHPShopGUI->loadLib('tab_print', $data);

    // ��������
    $PHPShopDeliveryArray = new PHPShopDeliveryArray();

    $DeliveryArray = $PHPShopDeliveryArray->getArray();
    if (is_array($DeliveryArray))
        foreach ($DeliveryArray as $delivery) {

            // ������� ������������
            if (strpos($delivery['city'], '.')) {
                $name = explode(".", $delivery['city']);
                $delivery['city'] = $name[0];
            }

            $delivery_value[] = array($delivery['city'], $delivery['id'], $order['Person']['dostavka_metod'], 'data-subtext="' . $delivery['price'] . ' ' . $currency . '"');
        }

    $delivery_content[] = $PHPShopGUI->setSelect('person[dostavka_metod]', $delivery_value, 180);

    $sidebarright[] = array('title' => '���������� � ��������', 'content' => $delivery_content);
    $sidebarright[] = array('title' => '�������� ������', 'content' => $Tab_print, 'idelement' => 'letterheads');

    // �������
    $Tab2 = $PHPShopGUI->loadLib('tab_cart', $data);

    // ������ ����������
    $Tab3 = $PHPShopGUI->loadLib('tab_userdata', $data, false, $order);

    // ��� ������ ������������
    $Tab4 = $PHPShopGUI->loadLib('tab_userorders', $data, false, array('status' => $OrderStatusArray, 'currency' => $currency, 'color' => $OrderStatusArray));

    // �����
    $Tab5 = $PHPShopGUI->loadLib('tab_files', $data, false, $order);

    // ������ �������
    $PHPShopGUI->setSidebarRight($sidebarright);

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("�������", $Tab2), array("������ ����������", $Tab3), array("������ ������������", $Tab4), array("���������", $Tab5));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.order.remove") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.order.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.order.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

/**
 * ���������� ������������ � ����� �������
 * @param array $data ������ ������ ������
 */
function sendUserMail($data) {
    global $PHPShopSystem;

    if ($data['statusi'] != $_POST['statusi_new']) {
        PHPShopObj::loadClass("parser");
        PHPShopObj::loadClass("mail");
        PHPShopParser::set('ouid', $data['uid']);
        PHPShopParser::set('date', PHPShopDate::dataV($data['datas']));

        // ��������� ������� ������� ���� ����� ���� #mail_action
        $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
        if ($PHPShopOrderStatusArray->getParam($_POST['statusi_new'] . '.mail_action') == 1) {
            PHPShopParser::set('status', $PHPShopOrderStatusArray->getParam($_POST['statusi_new'] . '.name'));
            PHPShopParser::set('fio', $data['fio']);
            PHPShopParser::set('sum', $data['sum']);
            PHPShopParser::set('company', $PHPShopSystem->getParam('name'));
            PHPShopParser::set('manager', $_POST['status']['maneger']);
            $title = __('C����� ������') . ' ' . $data['uid'] . ' ' . ('�������');
            $order = unserialize($data['orders']);

            $message = $PHPShopOrderStatusArray->getParam($_POST['statusi_new'] . '.mail_message');

            if (strlen($message) < 7)
                $message = '<h3>' . __('������ ������ ������') . ' �' . $data['uid'] . '  ' . ('��������� ��') . ' "' . $PHPShopOrderStatusArray->getParam($_POST['statusi_new'] . '.name') . '"</h3>';

            PHPShopParser::set('message', preg_replace_callback("/@([a-zA-Z0-9_]+)@/", 'PHPShopParser::SysValueReturn', $message));

            $PHPShopMail = new PHPShopMail($order['Person']['mail'], $PHPShopSystem->getValue('adminmail2'), $title, '', true, true);
            $content = PHPShopParser::file('../lib/templates/order/status.tpl', true);
            if (!empty($content)) {
                $PHPShopMail->sendMailNow($content);
            }
        }
    }
}

/**
 * ����� ����������
 * @return bool
 */
function actionUpdate() {
    global $PHPShopModules, $PHPShopOrm;

    // ������ �� ������
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_POST['rowID'])));
    $order = unserialize($data['orders']);

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ��������� �� ����� ������
    if (is_array($_POST['person'])) {

        // ����� ������
        if (is_array($_POST['person']))
            foreach ($_POST['person'] as $k => $v)
                $order['Person'][$k] = $v;

        // ��������
        $PHPShopCart = new PHPShopCart($order['Cart']['cart']);


        if (empty($order['Cart']['delivery_free'])) {
            $PHPShopDelivery = new PHPShopDelivery($_POST['person']['dostavka_metod']);
            $PHPShopDelivery->checkMod($order['Cart']['dostavka']);
            $order['Cart']['dostavka'] = $PHPShopDelivery->getPrice($PHPShopCart->getSum(false), $PHPShopCart->getWeight());
        }

        // ���������� ������
        $PHPShopOrder = new PHPShopOrderFunction(false, $order['Cart']['cart']);

        // ����������� � ����� ���������
        $_POST['status']['time'] = PHPShopDate::dataV();
        $_POST['status_new'] = serialize($_POST['status']);

        // ���������� ������ � ����������
        $sum = $sum_promo = 0;
        if (is_array($PHPShopCart->_CART))
            foreach ($PHPShopCart->_CART as $val) {

                // ����� ������� � �������
                if (!empty($val['promo_price'])) {
                    $sum_promo+=$val['num'] * $val['price'];
                }
                // ����� ������� ��� �����
                else
                    $sum+=$val['num'] * $val['price'];
            }

        // ����� ������ �� �����
        $order['Cart']['sum'] = $PHPShopOrder->returnSumma($sum_promo);

        // ����� ������ ��� �����
        $order['Cart']['sum'] += $PHPShopOrder->returnSumma($sum, $order['Person']['discount']);

        // ������
        $discount = $PHPShopOrder->ChekDiscount($sum);
        if ($order['Person']['discount'] > $discount)
            $discount = $order['Person']['discount'];


        $order['Person']['discount'] = $discount;

        // ������������ ������ ������
        $_POST['orders_new'] = serialize($order);

        // �����
        if (isset($_POST['editID'])) {
            if (is_array($_POST['files_new'])) {
                foreach ($_POST['files_new'] as $k => $files)
                    $files_new[$k] = @array_map("urldecode", $files);

                $_POST['files_new'] = serialize($files_new);
            }
        }
        else
            $_POST['files_new'] = serialize($_POST['files_new']);

        // �����
        $_POST['sum_new'] = $order['Cart']['sum'] + $order['Cart']['dostavka'];
    }
    // ������ ����� �������
    else {

        // ����������� � ����� ���������
        $status = unserialize($data['status']);
        $status['time'] = PHPShopDate::dataV();
        $_POST['status_new'] = serialize($status);
    }

    $PHPShopOrm->clean();

    // ���������� �� ������ �� �������
    updateStore($data);

    // ���������� ������������ � ����� �������
    sendUserMail($data);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . intval($_POST['rowID'])));

    // ������������ ������
    updateDiscount($data);

    return array('success' => $action);
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules, $PHPShopBase;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    // �������� ���� �� ��������
    if ($PHPShopBase->Rule->CheckedRules('order', 'remove')) {

        $PHPShopOrm->debug = false;
        $action = $PHPShopOrm->delete(array('id' => '=' . intval($_POST['rowID'])));
    }
    else
        $action = false;

    return array('success' => $action);
}

/**
 * ����� ������������� ������� �� ���������� ����
 */
function actionValueEdit() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem;

    // �� ������
    $orderID = intval($_REQUEST['id']);

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $orderID), false, array('limit' => 1));

    $order = unserialize($data['orders']);

    // �� ������
    $productID = urldecode($_REQUEST['selectID']);

    if (empty($order['Cart']['cart'][$productID])) {
        foreach ($order['Cart']['cart'] as $key => $val)
            if ($val['id'] == $productID) {
                $productID = $key;
            }
    }

    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->_CODE.= $PHPShopGUI->setField('��������', $PHPShopGUI->setInputArg(array('name' => 'name_value', 'type' => 'text.required', 'value' => $order['Cart']['cart'][$productID]['name'])));
    $PHPShopGUI->_CODE.= $PHPShopGUI->setField('����������', $PHPShopGUI->setInputArg(array('name' => 'num_value', 'type' => 'text', 'value' => $order['Cart']['cart'][$productID]['num'], 'size' => 100)));
    $PHPShopGUI->_CODE.= $PHPShopGUI->setField('����', $PHPShopGUI->setInputArg(array('name' => 'price_value', 'type' => 'text', 'value' => $order['Cart']['cart'][$productID]['price'], 'size' => 150, 'description' => $PHPShopSystem->getDefaultValutaCode())));

    $PHPShopGUI->_CODE.=$PHPShopGUI->setInputArg(array('name' => 'rowID', 'type' => 'hidden', 'value' => $productID));
    $PHPShopGUI->_CODE.=$PHPShopGUI->setInputArg(array('name' => 'orderID', 'type' => 'hidden', 'value' => $orderID));
    $PHPShopGUI->_CODE.=$PHPShopGUI->setInputArg(array('name' => 'parentID', 'type' => 'hidden', 'value' => $_REQUEST['parentID']));

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    exit($PHPShopGUI->_CODE . '<p class="clearfix"> </p>');
}

/**
 * ����� ���������� ������� �� ���������� ����
 */
function actionCartUpdate() {
    global $PHPShopModules, $PHPShopOrm;

    // �� ������
    $orderID = intval($_REQUEST['id']);

    // �� ������
    $productID = PHPShopString::utf8_win1251($_REQUEST['selectID']);

    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $orderID), false, array('limit' => 1));
    if (is_array($data)) {
        $order = unserialize($data['orders']);
        $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);

        // ���������� �������
        $PHPShopCart = new PHPShopCart($order['Cart']['cart']);

        // �������� � ��������
        switch ($_POST['selectAction']) {

            // ���������� ������
            case "discount":

                $order['Person']['discount'] = floatval($_REQUEST['selectID']);
                break;

            // �������� ������ �� �������
            case "delete":
                unset($order['Cart']['cart'][$productID]);
                break;

            // ���������� ������
            case "add":

                // ���������� ������ �� ID
                if (!empty($productID)) {


                    // ����������
                    if (empty($_SESSION['selectCart'][$productID])) {

                        // ��������� ����� ����� 1 �� �� ID
                        if ($PHPShopCart->add($productID, abs($_REQUEST['selectNum']))) {

                            // ���������� ������ ���������� �������
                            $order['Cart']['cart'] = $PHPShopCart->getArray();
                            $order['Cart']['num'] = $PHPShopCart->getNum();
                            $order['Cart']['sum'] = $PHPShopCart->getSum(false);
                        }
                    }

                    // �������������� ���-��
                    else {

                        if ($_SESSION['selectCart'][$productID]['num'] != abs($_REQUEST['selectNum'])) {

                            $PHPShopCart->edit($productID, abs($_REQUEST['selectNum']));

                            // ���������� ������ ���������� �������
                            $order['Cart']['cart'] = $PHPShopCart->getArray();
                            $order['Cart']['num'] = $PHPShopCart->getNum();
                            $order['Cart']['sum'] = $PHPShopCart->getSum(false);
                        }
                    }
                }
                break;

            // ���������� ���� � ���-��
            default:
                // ��� ������
                if (!empty($_POST['name_value']))
                    $order['Cart']['cart'][$productID]['name'] = $_POST['name_value'];

                // ����������
                if (!empty($_POST['num_value']))
                    $order['Cart']['cart'][$productID]['num'] = $_POST['num_value'];

                // ����
                if (!empty($_POST['price_value']))
                    $order['Cart']['cart'][$productID]['price'] = $_POST['price_value'];
        }

        $PHPShopOrder = new PHPShopOrderFunction(false, $order['Cart']['cart']);


        // ���������� �������
        $PHPShopCart = new PHPShopCart($order['Cart']['cart']);

        // ���������� ������ � ����������
        $sum = $sum_promo = 0;
        if (is_array($PHPShopCart->_CART))
            foreach ($PHPShopCart->_CART as $val) {

                // ����� ������� � �������
                if (!empty($val['promo_price'])) {
                    $sum_promo+=$val['num'] * $val['price'];
                }
                // ����� ������� ��� �����
                else
                    $sum+=$val['num'] * $val['price'];
            }

        // ����� ������ �� �����
        $order['Cart']['sum'] = $PHPShopOrder->returnSumma($sum_promo);

        // ����� ������ ��� �����
        $order['Cart']['sum'] += $PHPShopOrder->returnSumma($sum, $order['Person']['discount']);

        $order['Cart']['num'] = $PHPShopCart->getNum();
        $order['Cart']['weight'] = $PHPShopCart->getWeight();

        if (empty($order['Cart']['delivery_free'])) {
            $PHPShopDelivery->checkMod($order['Cart']['dostavka']);
            $order['Cart']['dostavka'] = $PHPShopDelivery->getPrice($PHPShopCart->getSum(false), $PHPShopCart->getWeight());
        }

        // ������������ ������ ������
        $update['orders_new'] = serialize($order);
        $update['sum_new'] = $order['Cart']['sum'] + $order['Cart']['dostavka'];
        $PHPShopOrm->clean();
        $PHPShopCart->clean();

        // �������� ������
        $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

        $action = $PHPShopOrm->update($update, array('id' => '=' . $orderID));

        return array('success' => $action);
    }
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>