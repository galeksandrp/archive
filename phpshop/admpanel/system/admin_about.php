<?php

$TitlePage = __("� ���������");

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $version, $PHPShopBase;

    // �������� ��������
    if (!empty($_POST['loadLic'])) {
        $licFile = PHPShopFile::searchFile('../../license/', 'getLicense', true);
        if(!empty($licFile)){
        if(@unlink("../../license/" . $licFile))
                $Tab1 = $PHPShopGUI->setAlert(__('������ �������� �������. ��� �������������� �������� ����� �������� � ������� ������������ �������� <a href="../../">������� �������� ��������-��������</a>'));
                else 
                    $Tab1 = $PHPShopGUI->setAlert(__('������ ����������, ��� ���� �� ��������� ������'), $type = 'warning');
        }
    }

    $licFile = PHPShopFile::searchFile('../../license/', 'getLicense', true);
    @$License = parse_ini_file("../../license/" . $licFile, 1);

    $TechPodUntilUnixTime = $License['License']['SupportExpires'];
    if (is_numeric($TechPodUntilUnixTime))
        $TechPodUntil = PHPShopDate::get($TechPodUntilUnixTime);
    else
        $TechPodUntil = " ��������������� ����� ";

    $DomenLocked = $License['License']['DomenLocked'];
    if (empty($DomenLocked))
        $DomenLocked = $_SERVER['SERVER_NAME'];


    $LicenseUntilUnixTime = $License['License']['Expires'];
    if (is_numeric($LicenseUntilUnixTime))
        $LicenseUntil = PHPShopDate::get($LicenseUntilUnixTime);
    else
        $LicenseUntil = " ��� ����������� ";

    if ($License['License']['Pro'] == 'Start') {
        $product_name = 'Start';
        $mod_limit = '�������� <b>5</b> �������. <a href="http://www.phpshop.ru/order/?from=' . $_SERVER['SERVER_NAME'] . '" target="_blank">����� ����������� Start?</a>';
    } else {
        if ($License['License']['Pro'] == 'Enabled')
            $product_name = 'Pro 1C';
        else
            $product_name = 'Enterprise';
        $mod_limit = '��� �����������';
    }


    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./system/gui/system.gui.js');
    $PHPShopGUI->setActionPanel(__("� ��������� PHPShop"), false, false);
    
    if(empty($License['License']['Serial'])){
        $loadLicClass = 'hide';
        $License['License']['Serial'] = " ��������������� ����� ";
    }
    else $loadLicClass=null;


    // ���������� �������� 1
    $Tab1 .= $PHPShopGUI->setCollapse(__('����������'), $PHPShopGUI->setField("�������� ���������", '<a class="btn btn-sm btn-default" href="http://www.phpshop.ru/page/compare.html?from=' . $_SERVER['SERVER_NAME'] . '" target="_blank"><span class="glyphicon glyphicon-info-sign"></span> PHPShop ' . $product_name . '</a>') .
            $PHPShopGUI->setField("������ ���������", '<a class="btn btn-sm btn-default" href="http://www.phpshop.ru/docs/update.html?from=' . $_SERVER['SERVER_NAME'] . '" target="_blank"><span class="glyphicon glyphicon-info-sign"></span> ' . substr($version, 0, strlen($version) - 1) . '</a>') .
            $PHPShopGUI->setField("������������ ������", $mod_limit, false, false, false, 'text-right') .
            $PHPShopGUI->setField("��������� ���������", $TechPodUntil, false, false, false, 'text-right') .
            $PHPShopGUI->setField("��������� ��������", $LicenseUntil, false, false, false, 'text-right') .
            $PHPShopGUI->setField("���� ��������", '/license/' . $licFile, false, false, false, 'text-right') .
            $PHPShopGUI->setField("�������� �����", $License['License']['Serial'] . "&nbsp;&nbsp;" . '<button name="loadLic" value="1" type="submit" class="btn btn-sm btn-default  '.$loadLicClass.'" target="_blank"><span class="glyphicon glyphicon-hdd"></span> ' . __('����������������') . '</button>', false, __('��������� ��� ��������� Pro 1�'), false, 'text-right') .
            $PHPShopGUI->setField("������ PHP", phpversion(), false, false, false, 'text-right') .
            $PHPShopGUI->setField("������ MySQL", @mysqli_get_server_info($PHPShopBase->link_db), false, false, false, 'text-right'));
    
    if(!empty($TechPodUntilUnixTime) and time() > $TechPodUntilUnixTime)
            $Tab1 .= $PHPShopGUI->setField(false, '</form><form method="post" target="_blank" enctype="multipart/form-data" action="http://www.phpshop.ru/order.html" name="product_upgrade" id="product_support" style="display:none">
<input type="hidden" value="supportenterprise" name="addToCartFromPages" id="addToCartFromPages">             
<input type="hidden" value="' . $DomenLocked . '" name="addToCartFromPagesDomen" id="addToCartFromPagesDomen">
</form><form><a class="btn btn-sm btn-primary pay-support" href="#" target="_blank"><span class="glyphicon glyphicon-ruble"></span> ' . __('���������� ����������� ���������') . '</a>');


    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $License);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("������������ ����������", $PHPShopGUI->loadLib('tab_license', false, './system/'), true));

    // �����
    $PHPShopGUI->Compile();
    return true;
}

?>