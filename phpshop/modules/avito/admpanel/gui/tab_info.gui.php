<?php

function tab_info($data) {
    global $PHPShopGUI;
    
    $Info = '<p>
      <h4>������������ ��������� ����� ������ �� ������ XML ����:</h4>
        <ol>
            <li>
                ��� ���������: <code>http://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/phpshop/modules/avito/xml/all.php</code>   
            </li>     
            <li>
                ������� �����������: <code>http://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/phpshop/modules/avito/xml/appliances.php</code>   
            </li> 
            <li>
                ��� ���� � ����: <code>http://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/phpshop/modules/avito/xml/home.php</code>   
            </li> 
            <li>
                �������� � ����������: <code>http://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/phpshop/modules/avito/xml/spare.php</code>   
            </li> 
        </ol>
        <h4>��������� ������</h4>
        <ol>
       <li>���� ������ <b>��������</b> �� ������������������� ����� ��������. ��� ������������� ������ ������ �� ���� XML ������ ��� <code>http://' . $_SERVER['SERVER_NAME'] . '/phpshop/modules/avito/xml/����.php?pas=*******</code>. ��� ������������� ������ ��������� ��� �� �������� ������ � ��������� �����.
</li> </ol>
      <h4>��������� ���������</h4>
        <ol>
        <li>� ��������� ������� ������� <kbd>�����</kbd> ��������� ��������� ������ ��������� � �����.</li>
        <li>"��������� ������" - �������, ����� ��������� � ����� ������������� ��������� � ��������-��������.</li>
        <li>��������� ����� "��� ������".</li>
        </ol>
      <h4>��������� ������</h4>
        <ol>
        <li>� �������� �������������� ������ � �������� <kbd>�����</kbd> ��������� �������������� ��������� ������ ��� �����.</li>
        <li>�������� ����� "�������� ������� � �����".</li>
        <li>��������� ���� "�������� ������", ���� �� ��������� - ����� �������������� �������� ������.</li>
        <li>��������� ����� "��������� ������".</li>
        <li>��������� ����� "������� �������� ����������".</li>
        <li>��������� ����� "������� ������".</li>
        </ol>
        </p>';
    
    return $PHPShopGUI->setInfo($Info, 280, '98%');
}
?>
