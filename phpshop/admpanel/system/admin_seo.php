<?php

$TitlePage = __("SEO ���������");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['system']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();
    $option = unserialize($data['admoption']);
    ;

    // ������ �������� ����
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./js/jquery.waypoints.min.js', './system/gui/system.gui.js', './system/gui/tab_headers.gui.js');
    $PHPShopGUI->setActionPanel($TitlePage, false, array('���������'));

    $PHPShopGUI->_CODE .= '<p></p>' . $PHPShopGUI->setField('�������� ��������� (Title)', $PHPShopGUI->setTextarea('title_new', $data['title'], false, false, 100));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField('�������� �������� (Description)', $PHPShopGUI->setTextarea('descrip_new', $data['descrip'], false, false, 100));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField('�������� �������� ����� (Keywords)', $PHPShopGUI->setTextarea('keywords_new', $data['keywords'], false, false, 100));
    $PHPShopGUI->_CODE .=$PHPShopGUI->setField("��������� �����", $PHPShopGUI->setCheckbox('option[safe_links]', 1, '���������� ����������� ������ �� ������ ������� ��� ����������� ������ 404 ������', $option['safe_links']));

    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('������ ��������', $PHPShopGUI->loadLib('tab_headers', $data, './system/', 'catalog'));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('������ �����������', $PHPShopGUI->loadLib('tab_headers', $data, './system/', 'podcatalog'));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('������ ������', $PHPShopGUI->loadLib('tab_headers', $data, './system/', 'product'));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);


    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.system.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.system.edit");

    $PHPShopGUI->setFooter($ContentFooter);

    $sidebarleft[] = array('title' => '���������', 'content' => $PHPShopGUI->loadLib('tab_menu', false, './system/'));
    $PHPShopGUI->setSidebarLeft($sidebarleft, 2);

    // �����
    $PHPShopGUI->Compile(2);
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

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select();
    $option = unserialize($data['admoption']);
    
    // ������������� ������ ��������
    $PHPShopOrm->updateZeroVars('option.safe_links');
    
    if (is_array($_POST['option']))
        foreach ($_POST['option'] as $key => $val)
            $option[$key] = $val;
    
   
    $_POST['admoption_new'] = serialize($option);


    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));


    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();
?>