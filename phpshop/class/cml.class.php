<?php

/**
 * ���������� ������ � CommerceML
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopCommerceML {

    /**
     * �����������
     */
    function __construct() {
        
    }

    /**
     * ���������
     * @param array $where ������� ������
     * @return array
     */
    function category($where) {
        $Catalog = array();
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);

        // �� �������� ������� ��������
        $where['skin_enabled'] = "!='1'";

        $data = $PHPShopOrm->select(array('id,name,parent_to'), $where, false, array('limit' => 10000));
        if (is_array($data))
            foreach ($data as $row) {
                if ($row['id'] != $row['parent_to']) {
                    $Catalog[$row['id']]['id'] = $row['id'];
                    $Catalog[$row['id']]['name'] = $row['name'];
                    $Catalog[$row['id']]['parent_to'] = $row['parent_to'];
                }
            }

        return $Catalog;
    }

    /**
     * ���������
     * @param integer $id �� ���������
     * @return string
     */
    function setCategories($id) {
        $xml = '<������>';
        $category = $this->category(array('parent_to' => '=' . $id));
        foreach ($category as $val) {
            $xml .= '<������>
                <��>' . $val['id'] . '</��>
		<������������>' . $val['name'] . '</������������>';
            $parent = $this->setCategories($val['id']);
            if (!empty($parent))
                $xml .= $parent;
            else
                $xml .= '<������/>';
            $xml .= '</������>';
        }

        $xml .= '</������>';

        return $xml;
    }

    /**
     * ����������� ������
     * @param array $product_row
     * @return string
     */
    function getImages($product_row) {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);
        $data = $PHPShopOrm->select(array('*'), array('parent' => '=' . $product_row['id']), false, array('limit' => 10000));
        $xml = null;
        if (is_array($data))
            foreach ($data as $row) {
                $xml .= '<��������>http://' . $_SERVER['SERVER_NAME'] . $row['name'] . '</��������>';
            }

        if (empty($xml))
            $xml = '<��������>http://' . $_SERVER['SERVER_NAME'] . $product_row['pic_big'] . '</��������>';

        return $xml;
    }

    /**
     * ��������� CommerceML ��� �������
     * @param array $data
     * @return string
     */
    function getProducts($data) {
        global $PHPShopSystem;

        $xml = null;

        // ��������
        $category = $this->setCategories(0);

        // ������
        foreach ($data as $row)
            if (is_array($row)) {
                
                // ������� �������
                if($row['parent_enabled'] == 1)
                    continue;
                
                $item .= '
                        <�����>
			<��>' . $row['id'] . '</��>
			<�������>' . $row['uid'] . '</�������>
			<������������>' . $row['name'] . '</������������>
                        <�������������� ���="796 " ������������������="�����" �����������������������="PCE">' . $row['ed_izm'] . '</��������������>
                        <������������������><![CDATA[' . $row['description'] . ']]></������������������>
			<������>
				<��>' . $row['category'] . '</��>
			</������>
                        <��������><![CDATA[' . $row['content'] . ']]></��������>
			<�������������>
				<������������>
					<������������>���</������������>
					<������>' . $PHPShopSystem->getParam('nds') . '</������>
				</������������>
			</�������������>
			<������������������>
				<�����������������>
					<������������>���������������</������������>
					<��������>�����</��������>
				</�����������������>
				<�����������������>
					<������������>���</������������>
					<��������>' . $row['weight'] . '</��������>
				</�����������������>
			</������������������>
                        ' . $this->getImages($row['id']) . '
		</�����>
                ';
            }

                $items = ' <������� �����������������������="false">
	<��>1</��>
        <����������������>1</����������������>
	<������������>�������� ������� �������</������������>
		<������>
' . $item . '
		</������>
	</�������>';

                $xml = '<?xml version="1.0" encoding="windows-1251"?>
<���������������������� �����������="2.04" ����������������="' . PHPShopDate::get(time(), false, true) . '">
    <�������������>
    <��>1</��>
    <������������>������������� (�������� ������� �������)</������������>
    <��������>
       <��>1</��>
       <������������>' . $PHPShopSystem->getParam('name') . '</������������>
       <�����������������������>' . $PHPShopSystem->getParam('company') . '</�����������������������>
       <���>' . $PHPShopSystem->getParam('nds') . '</���>
       <���>' . $PHPShopSystem->getParam('kpp') . '</���>
    </��������>
	' . $category . '
    </�������������>
    ' . $items . '
</����������������������>';
                return $xml;
            
    }

    /**
     * ��������� CommerceML ��� ������
     * @param array $data
     * @return string
     */
    function getOrders($data) {
        global $PHPShopSystem;

        $xml = null;
        foreach ($data as $row)
            if (is_array($row)) {

                $PHPShopOrder = new PHPShopOrderFunction($row['id']);

                $num = 0;
                $id = $row['id'];
                $uid = $row['uid'];
                $order = unserialize($row['orders']);
                $status = unserialize($data['status']);
                $sum = $PHPShopOrder->returnSumma($order['Cart']['sum'], $order['Person']['discount']);

                $item = null;
                if (is_array($order['Cart']['cart']))
                    foreach ($order['Cart']['cart'] as $val) {
                        $id = $val['id'];
                        $uid = $val['uid'];
                        $num = $val['num'];
                        $sum = $PHPShopOrder->returnSumma($val['price'] * $num, $order['Person']['discount']);

                        $item .= '
                        <�����>
				<��>' . $val['id'] . '</��>
				<��������></��������>
				<�������>' . $val['uid'] . '</�������>
				<������������>' . $val['name'] . '</������������>
				<�������������>' . $val['price'] . '</�������������>
				<����������>' . $val['num'] . '</����������>
				<�����>' . $sum . '</�����>
				<�������>��</�������>
			</�����>
                        ';
                    }

                if (empty($row['fio']))
                    $row['fio'] = $row['org_name'];

                $xml .= '
	<��������>
		<�����>' . $row['uid'] . '</�����>
		<����>' . PHPShopDate::get($row['datas'], false, true) . '</����>
		<�����������>����� ������</�����������>
		<����>��������</����>
		<������>' . $PHPShopSystem->getDefaultValutaIso() . '</������>
		<�����>' . $row['sum'] . '</�����>
                <�����������>'.$status['maneger'].'</�����������>
		<����������>
                    <��>'.$row['user'].'</��>
		    <������������>' . $row['fio'] . '</������������>
		    <������������������>' . $row['org_name'] . '</������������������>
		    <���>' . $row['org_inn'] . '</���>
		    <���>' . $row['org_kpp'] . '</���>
		    <����>����������</����>
		</����������>
		<������>
' . $item . '
		</������>
	</��������>';
            }

        if (!empty($xml)) {
            $xml = '<?xml version="1.0" encoding="windows-1251"?>
<���������������������� �����������="2.04" ����������������="' . PHPShopDate::get(time(), false, true) . '">
	' . $xml . '
</����������������������>';
            return $xml;
        }
    }

}

?>