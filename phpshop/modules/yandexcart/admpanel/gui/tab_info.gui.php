<?php

function tab_info($data) {
    global $PHPShopGUI;
    
    $Info = '<p>
      <h4>��������� ���������� ���������� � ������.������ �� ������ ADV</h4>
        <ol>
        <li>� ���� "�����-����" ������� ����� YML �����: <code>http://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/yml/</code>
        </ol>
        <h5>��������� ������</h5>
        <ol>
        <li>� ������ ������� ������ ������ <kbd>ADV</kbd>. ������ ������ <b>���������</b></li>
       <li>���� ������ <b>��������</b> �� ������������������� ����� ��������. ��� ������������� ������ ������ �� ���� YML ������ ��� <code>http://' . $_SERVER['SERVER_NAME'] . '/yml/yandex.php?pas=*******</code>. ��� ������������� ������ ��������� ��� �� �������� ������ � ������.�������.
</li> 
        <li>���� SSL ��������� � ������� �� ����� �������� HTTPS.</li>
        <li>������� ��� ������ ��� ������ �������������� ��� �� �������� ������.</li>
      </ol>
      
      <h4>��������� ���������� ���������� � ������.������ �� ������ DBS</h4>
        <ol>
        <li>� ������ �������� ������.������ ������� <b>�����������</b>/<b>�������������� ���������� ��������</b>, ������� ����� YML �����: <code>http://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/yml/</code></li>
        <li>� ������ �������� ������.������ ������� <b>���������</b>/<b>����� ������� �������������</b>, ������� <b>��� �� ������ ������������ ������</b> �������� <kbd>����� API</kbd></li>
        <li>� ������ �������� ������.������ ������� <b>���������</b>/<b>��������� API</b>, ������� � ���� <kbd>URL ��� �������� API</kbd> �������� <code>https://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/phpshop/modules/yandexcart/api.php</code></li>
        <li>� ������� <b>��������� API</b> ��������� <kbd>SHA1-��������� SSL-�����������</kbd>, ��� ���������� ����� �� ���������� � SSL ����������� ������ �����.</li>
        <li>� ������� <b>��������� API</b> ������� <b>��� �����������</b> <kbd>URL</kbd>.</li>
        <li>� ������� <b>��������� API</b> �������� <kbd>�������������� ���������� ������ �� �������� �������</kbd>.</li>
        </ol>
        <h5>��������� ������</h5>
        <ol>
        <li>������� ������ ������ <kbd>DBS</kbd>. ������ ������ <b>���������</b></li>
        <li>���� ������ <b>��������</b> �� ������������������� ����� ��������. ��� ������������� ������ ������ �� ���� YML ������ ��� <code>http://' . $_SERVER['SERVER_NAME'] . '/yml/yandex.php?pas=*******</code>. ��� ������������� ������ ��������� ��� �� �������� ������ � ������.�������.</li> 
        <li>���� SSL ��������� � ������� �� ����� �������� HTTPS.</li>
        <li>������� ��� ������ ��� ������ �������������� ��� �� �������� ������.</li>
        <li>� ������ �������� ������.������ ������� <b>���������</b>/<b>��������� API</b> ����������� <kbd>��������������� �����</kbd> � ���� <kbd>��������������� ����� API</kbd> � ���������� ������.</li>
        <li>����� ������������ �������� OAuth ��� ������ � ����������� API, ��� ���������� <a href="https://oauth.yandex.ru/client/new" target="_blank">���������������� ���� ����������</a>. 
        ����������� ���������� ������ �������� ����������, ��� ����� ���� �����. � ������� <b>���������</b> ���������� ������� <kbd>���-�������</kbd>, ��� ����� <b>Callback URI #1</b> ������ <kbd>���������� URL ��� ����������</kbd>.
        � ������� <b>�������</b> ������� <kbd>������.������</kbd> � ���������� ������� <kbd>API ������.������� ��� ���������</kbd>. ������ <b>������� ����������</b>.
        ����� �������� ����������, ��� ����� �������� ������������� ���������� <kbd>client_id</kbd>. ���������� ������� �� ������ https://oauth.yandex.ru/authorize?response_type=token&client_id=��� client_id ������� � ��� <b>��� client_id</b> �� ���������� <b>client_id</b>.
        ���������� <b>client_id</b> ������� � ���� <kbd>ID ���������� ������.OAuth</kbd>, � <b>OAuth-�����</b> � ���� <kbd>OAuth-�����</kbd> �������� ������.</li>
        <li>� ������ �������� ������.������ ������ �� �������� ��������, ����������� �������� <b>�������� �</b> � ���� <kbd>������������� ��������</kbd> �������� ������.</li>
        <li>��������� ������������ �������� ������ � ������.������ �� ��������� ������ � ��������-��������. ��� ��������� ������� ������ �� ������, ��������������� �������� 
        "������ ������� � ������ ��������", "����� ��������� � ����� ����������", "������ ���������", "������� �� ����� ��������� �����", 
        "���������� ����� �������� ����� ������ �� ����������� ����������", "���������� ������� ����� �� ����������� ��������" ����� ������� ������ ������ � ������.�������.</li>
        <li>��������� ������������ �������� ������ � ������.������ �� ��������� ������ � ��������-��������.</li>
        </ol>
        
      <h4>��������� ���������� ���������� � ������.������ �� ������ FBS</h4>
        <ol>
        <li>� ������ �������� ������.������ ������� <b>���������</b>/<b>����� ������� �������������</b>, ������� <b>��� �� ������ ������������ ������</b> �������� <kbd>����� API</kbd></li>
        <li>� ������ �������� ������.������ ������� <b>���������</b>/<b>��������� API</b>, ������� � ���� <kbd>URL ��� �������� API</kbd> �������� <code>https://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/phpshop/modules/yandexcart/api.php</code></li>
        <li>� ������� <b>��������� API</b> ��������� <kbd>SHA1-��������� SSL-�����������</kbd>, ��� ���������� ����� �� ���������� � SSL ����������� ������ �����.</li>
        <li>� ������� <b>��������� API</b> ������� <b>��� �����������</b> <kbd>URL</kbd>.</li>
        <li>� ������� <b>��������� API</b> �������� <kbd>�������������� ���������� ������ �� �������� �������</kbd>.</li>
       </ol>
        <h5>��������� ������</h5>
        <ol>
        <li>� ������ ������� ������ ������ <kbd>FBS</kbd>. ������ ������ <b>���������</b></li>
        <li>� ������ �������� ������.������ ������� <b>���������</b>/<b>��������� API</b> ����������� <kbd>��������������� �����</kbd> � ���� <kbd>��������������� ����� API</kbd> � ���������� ������.</li>
        <li>� ������ �������� ������.������ ������� <b>���������</b>/<b>��������� API</b>, ������� � ���� <kbd>URL ��� �������� API</kbd> �������� <code>https://' . $_SERVER['SERVER_NAME'] .$GLOBALS['SysValue']['dir']['dir']. '/phpshop/modules/yandexcart/api.php</code></li>
        <li>����� ������������ �������� OAuth ��� ������ � ����������� API, ��� ���������� <a href="https://oauth.yandex.ru/client/new" target="_blank">���������������� ���� ����������</a>. 
        ����������� ���������� ������ �������� ����������, ��� ����� ���� �����. � ������� <b>���������</b> ���������� ������� <kbd>���-�������</kbd>, ��� ����� <b>Callback URI #1</b> ������ <kbd>���������� URL ��� ����������</kbd>.
        � ������� <b>�������</b> ������� <kbd>������.������</kbd> � ���������� ������� <kbd>API ������.������� ��� ���������</kbd>. ������ <b>������� ����������</b>.
        ����� �������� ����������, ��� ����� �������� ������������� ���������� <kbd>client_id</kbd>. ���������� ������� �� ������ https://oauth.yandex.ru/authorize?response_type=token&client_id=��� client_id ������� � ��� <b>��� client_id</b> �� ���������� <b>client_id</b>.
        ���������� <b>client_id</b> ������� � ���� <kbd>D ���������� ������.OAuth</kbd>, � <b>OAuth-�����</b> � ���� <kbd>OAuth-�����</kbd> �������� ������.</li>
        <li>� ������ �������� ������.������ ������ �� �������� ��������, ����������� �������� <b>�������� �</b> � ���� <kbd>������������� ��������</kbd> �������� ������.</li>
        <li>��������� ������������ �������� ������ � ������.������ �� ��������� ������ � ��������-��������.</li>
        <li>��������� ������������ �������� ������ � ������.������ �� ��������� ������ � ��������-��������.</li>
        <li>��������� ����������� ������ � ������� (��. ������ <b>��������� ������</b>).</li>
        <li>�������������� ������ � ������.������ ������� <kbd>�������������� ������</kbd>.</li>
        </ol>
        
      <h4>��������� ������</h4>
        <ol>
        <li>� �������� �������������� ������ � �������� <kbd>������.�����</kbd> ��������� �������������� ��������� ������ ��� ������.�������.</li>
        <li>��������� ��� � ��� ������������. ��� ������������� ����� ��� �� ������� ����� �������������� �����.</li>
        <li>��������� ����� ������ ������� � ������ �������� �������������.</li>
        <li>��������� �����������. ����������� ������������ ��� ��������� ���������� � ����������� ����� ������, 
            ����������� ������ ������, ������������� ���������� (�������� �������� �����������) ��� ��������� ������, �������� ����� � ���������. ���������� ����� ������ � �������� � 50 ��������.</li>
        <li>��������� ����� ������ ������ �������������.</li>
        <li>��������� ����� �������������� � ������� ��� ��������. ���������� ��� ����������� ������, �������� ��������� � �������������� ����������� ������������, 
            ���� ���� ������� ���������������� ������� � �����.</li>
        <li>��������� ����������� ���������� �������� ������.</li>
        <li>��������� ����������� ���������� ������ �� ������� ������.</li>
        <li>��������� ����������� ������� ������ � ��������� ��������.</li>
        <li>��� ���������� �� ������ FBS � ������� ���������� ��������� <kbd>���</kbd>, <kbd>�����</kbd>, <kbd>������</kbd>, <kbd>������</kbd> �� ������� <kbd>��������</kbd>. 
        � ��������� <kbd>�������� �������������, ����� � ���. ����� (���� ����)</kbd>, <kbd>������ ������������</kbd> �� ������� <kbd>������</kbd></li>
        </ol>
        
      <h4>��������� ��������</h4>
        <ol>
        <li>� �������� �������������� �������� � �������� <kbd>������.�����</kbd> ��������� �������������� ��������� ������ ��� ������.�������.
        <li>��������� ������������ ���������� ���� ��������.
        <li>��������� ����� ������ ��� ���������� ����� ��������.
        <li>��������� ����� ������ �������� ��� ������.�������.
        <li>��������� ����� �������������� �������� ������ ��� ���������� �������.
        <li>��������� �������� ���� �������� (����������, ��������� ��� �����).
        <li>��� ������ DBS ���������� �������� ������ ������� �������� ��� ������.�������. ���������� ������ �������� ��������
            ������� �������� ������.����� <kbd>��������</kbd> 
        <li>��� ������ DBS ����� �������, ��� ������ ������� ����� ������������ ������ ��������. ���������� ��������� ���� <kbd>������ ��������</kbd> 
        <li>��� ������ DBS � ������� �������� <kbd>���������</kbd> ����������� ����� ������� ������� ���� <kbd>����� ������</kbd>. ����� ������ ���������� ������� � ������ �������� ������.������.
        </ol>
        
      <h4>��������� ��������������</h4>
        <ol>
        <li>� �������� �������������� �������������� � �������� <kbd>������.�����</kbd> ��������� �������������� ��������� ������ ��� ������.�������.
        <li>��������� ����� ������ �������������� ��� ��� ������.�������. ���������� �������������� ��������� � YML ����� � ����� "Param"
        <li>��������� ������� ��������� ��� �������� ���������� (����, ��, �� � �.�.)
        </ol>
        

      <h4>SQL ������� ��� �������� ���������</h4>
      <p>
      ��� ������������� SQL ������ � ����������� ������� �������� ������� ����������� ������ ���������� ��������� <kbd>����</kbd> -  <kbd>SQL ������ � ����</kbd>.
      </p>
       <table class="table table-bordered table-striped">
   <thead>
        <tr>
          <th>#</th>
          <th>SQL</th>
          <th>��������</th>
        </tr>
      </thead>
    <tbody>
        <tr>
          <th scope="row">1</th>
          <td>update phpshop_products set manufacturer_warranty=\'1\';</td>
          <td>��������� �������� � ������.������� ��� ���� �������</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>update phpshop_products set sales_notes="����������� ������ - 1��; ����������� ����� ������ - 1000 ���.";</td>
          <td>��������� ����������� �� ���� ������� ��� ������.�������</td>
        </tr>
         <tr>
          <th scope="row">3</th>
          <td>update phpshop_products set country_of_origin="��������";</td>
          <td>��������� ������ ������������� �� ���� ������� ��� ������.�������</td>
        </tr>
         <tr>
          <th scope="row">4</th>
          <td>update phpshop_products set yml=\'0\' where price<1 or items<1;</td>
          <td>������ ������� ������� � ������.������� (������ �� ��������) ��� ������ ������ ��� ������� ����</td>
        </tr>
         <tr>
          <th scope="row">5</th>
          <td>update phpshop_products set yml=\'1\' where price>0 or items>0;</td>
          <td>������ ������� ������� � ������.������� (������ �� ��������) ��� ������������� ������ ��� ������� ����</td>
        </tr>
   </tbody>
</table>
        

        </p>';
    
    return $PHPShopGUI->setInfo($Info, 280, '98%');
}
?>
