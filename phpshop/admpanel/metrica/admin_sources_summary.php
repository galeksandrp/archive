<?php

$TitlePage = __("���������� - ���������, ������");

function actionStart() {
    global $PHPShopInterface, $TitlePage, $select_name, $PHPShopSystem;

    // ���������
    $metrica_id = $PHPShopSystem->getSerilizeParam('admoption.metrica_id');
    $metrica_token = $PHPShopSystem->getSerilizeParam('admoption.metrica_token');

    $PHPShopInterface->action_button['�������� � �������'] = array(
        'name' => '����� �� ������.�������',
        'action' => 'https://metrika.yandex.ru/stat/sources?id=' . $metrica_id,
        'class' => 'btn  btn-default btn-sm navbar-btn btn-action-panel-blank',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-export'
    );

    $PHPShopInterface->checkbox_action = false;
    $PHPShopInterface->addJSFiles('./js/bootstrap-datetimepicker.min.js', './js/bootstrap-datetimepicker.ru.js', 'metrica/gui/metrica.gui.js');
    $PHPShopInterface->addCSSFiles('./css/bootstrap-datetimepicker.min.css');

    if (empty($_GET['date_start']))
        $date_start = date('Y-m-d');
    else {
        $date_start = $_GET['date_start'];
        $clean = true;
    }

    if (empty($_GET['date_end']))
        $date_end = date('Y-m-d');
    else
        $date_end = $_GET['date_end'];


    // ��������
    if (!empty($_GET['group_date'])) {
        switch ($_GET['group_date']) {
            case "today":
                $date_start = date('Y-m-d');
                $date_end = date('Y-m-d');
                break;
            case "yesterday":
                $date_start = date('Y-m-d', strtotime("-1 day"));
                $date_end = date('Y-m-d');
                break;
            case "week":
                $date_start = date('Y-m-d', strtotime("-7 day"));
                $date_end = date('Y-m-d');
                break;
            case "month":
                $date_start = date('Y-m-d', strtotime("-1 month"));
                $date_end = date('Y-m-d');
                break;
            case "quart":
                $date_start = date('Y-m-d', strtotime("-3 month"));
                $date_end = date('Y-m-d');
                break;
            case "year":
                $date_start = date('Y-m-d', strtotime("-12 month"));
                $date_end = date('Y-m-d');
                break;
        }
    }

    $TitlePage.=' � ' . $date_start . ' �� ' . $date_end;

    if (empty($_GET['group'])) {
        $_GET['group'] = 'day';
    }

    $array_url_data = array(
        'preset' => 'sources_summary',
        'metrics' => 'ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds',
        'group' => $_GET['group'],
        'date1' => $date_start,
        'date2' => $date_end,
        'id' => $metrica_id,
        'oauth_token' => $metrica_token,
    );

    $url = 'https://api-metrika.yandex.ru/stat/v1/data?' . http_build_query($array_url_data);
    $�url = curl_init();
    curl_setopt_array($�url, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array('Authorization: OAuth ' . $metrica_token),
    ));

    $json_data = json_decode(curl_exec($�url), true);
    curl_close($�url);

    if (empty($json_data))
        $json_data = json_decode(file_get_contents($url), true);

    $PHPShopInterface->setActionPanel($TitlePage, $select_name, array('�������� � �������'));
    $PHPShopInterface->setCaption(array("�������� �������", "40%"), array("������", "10%"), array("����������", "10%"), array("������", "10%"), array("�������", "10%"), array("�����", "10%", array('align' => 'left')));

    if (is_array($json_data)) {

        $PHPShopInterface->setRow('����� � �������', $json_data[totals][0], $json_data[totals][1], round($json_data[totals][2], 2) . '%', round($json_data[totals][3], 2), round($json_data[totals][4] / 60, 2));


        $json_data = $json_data[data];


        foreach ($json_data as $key => $value) {

            $name = $json_data[$key][dimensions][0][name];
            $name_1 = $json_data[$key][dimensions][1][name];
            $visits = $json_data[$key][metrics][0];
            $users = $json_data[$key][metrics][1];
            $bounceRate = $json_data[$key][metrics][2];
            $pageDepth = $json_data[$key][metrics][3];
            $avgVisitDurationSeconds = $json_data[$key][metrics][4] / 60;
            $icon = '<img src="//favicon.yandex.net/favicon/' . $json_data[$key][dimensions][1][favicon] . '/" style="padding-right:5px" />';

            // ���������
            if (strstr($name_1, '.'))
                $name_1 = '<a target="_blank" href="http://' . $name_1 . '">' . $name_1 . '</a>';

            if (!empty($name_1))
                $name.=' &rarr; ' . $icon . $name_1;

            $PHPShopInterface->setRow(PHPShopString::utf8_win1251($name), $visits, $users, round($bounceRate, 2) . '%', round($pageDepth, 2), round($avgVisitDurationSeconds, 2));
        }
    }

    $searchforma.=$PHPShopInterface->setInputDate("date_start", $date_start, 'margin-bottom:10px', null, '���� ������ ������');
    $searchforma.=$PHPShopInterface->setInputDate("date_end", $date_end, false, null, '���� ����� ������');
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'hidden', 'name' => 'path', 'value' => $_GET['path']));

    /*
      $group_value[] = array(__('�� ����'), 'day', $_GET['group']);
      $group_value[] = array(__('�� �������'), 'week', $_GET['group']);
      $group_value[] = array(__('�� �������'), 'month', $_GET['group']);
      $searchforma.= $PHPShopInterface->setSelect('group', $group_value, 180);
     */

    $group_date_value[] = array(__('��������'), 0, $_GET['group_date']);
    $group_date_value[] = array(__('�������'), 'today', $_GET['group_date']);
    $group_date_value[] = array(__('�����'), 'yesterday', $_GET['group_date']);
    $group_date_value[] = array(__('������'), 'week', $_GET['group_date']);
    $group_date_value[] = array(__('�����'), 'month', $_GET['group_date']);
    $group_date_value[] = array(__('�������'), 'quart', $_GET['group_date']);
    $group_date_value[] = array(__('���'), 'year', $_GET['group_date']);
    $searchforma.= $PHPShopInterface->setSelect('group_date', $group_date_value, 180);

    $searchforma.=$PHPShopInterface->setButton('��������', 'search', 'btn-order-search pull-right');

    if ($clean)
        $searchforma.=$PHPShopInterface->setButton('�����', 'remove', 'btn-order-cancel pull-left visible-lg');


    $sidebarright[] = array('title' => '������', 'content' => $PHPShopInterface->loadLib('tab_menu', false, './metrica/'));
    $sidebarright[] = array('title' => '��������', 'content' => $PHPShopInterface->setForm($searchforma, false, "order_search", false, false, 'form-sidebar'));

    $PHPShopInterface->setSidebarRight($sidebarright, 2);

    $PHPShopInterface->Compile($form = false);
}

?>