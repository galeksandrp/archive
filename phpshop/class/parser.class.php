<?php

/**
 * ���������� �������� ������
 * @author PHPShop Software
 * @version 1.4
 * @package PHPShopClass
 */
class PHPShopParser {

    /**
     * �������� ������� �� ����������� ����������
     * @param string $path ���� � ����� �������
     * @param string $value ���������� ������������
     * @return boolean 
     */
    static function check($path, $value) {
        $string = null;
        $path = $GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'] . chr(47) . $path;
        if (file_exists($path))
            $string = @file_get_contents($path);
        else
            echo "Error Tmp File: $path";
        if (stristr($string, '@' . $value . '@'))
            return true;
    }

    /**
     * ��������  ����� ������� �� ����������� � ��� ����� �������
     * @param string $path ���� � ����� �������
     * @return boolean 
     */
    static function checkFile($path, $mod = false) {
        if (!$mod)
            $path = $GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'] . chr(47) . $path;
        if (file_exists($path))
            return true;
        else
            return false;
    }

    /**
     * ��������� ����� �������, ������� �����������
     * @param string $path ���� � ����� �������
     * @param bool $return ����� ������ ���������� ��� �������� ����������
     * @param bool $replace ����� ������ 
     * @return string
     */
    static function file($path, $return = false, $replace = true) {

        $string = null;
        if (is_file($path))
            $string = @file_get_contents($path);
        else
            echo "Error Tpl File: $path";

        $replaces = array(
            "/images\//i" => $GLOBALS['SysValue']['dir']['dir'] . $GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'] . "/images/",
            "/!images!\//i" => "images/",
            "/java\//i" => "/java/",
            "/css\//i" => "/css/",
            "/phpshop\//i" => "/phpshop/",
        );

        $string = @preg_replace_callback("/(@php)(.*)(php@)/sU", "phpshopparserevalstr", $string);
        $string = @preg_replace("/@([a-zA-Z0-9_]+)@/e", '$GLOBALS["SysValue"]["other"]["\1"]', $string);

        if (!empty($replace))
        $string = preg_replace(array_keys($replaces), array_values($replaces), $string);

        if (!empty($return))
            return $string;
        else
            echo $string;
    }

    /**
     * �������� ��������� ���������� ��� ��������
     * @param string $name ���
     * @param mixed $value ��������
     * @param bool $flag [1] - ��������, [0] - ����������
     */
    static function set($name, $value, $flag = false) {
        if ($flag)
            $GLOBALS['SysValue']['other'][$name].=$value;
        else
            $GLOBALS['SysValue']['other'][$name] = $value;
    }

    /**
     * ������ ��������� ����������
     * @param string $name
     * @return string
     */
    static function get($name) {
        return $GLOBALS['SysValue']['other'][$name];
    }

}

// ��������� php �����
function phpshopparserevalstr($str) {
    ob_start();
    if (eval(stripslashes($str[2])) !== NULL) {
        echo ('<center style="color:red"><br><br><b>PHPShop Template Code: � ������� ���������� ������ ���������� php</b><br>');
        echo ('��� ���������� ������:');
        echo ('<pre>');
        echo ($str[2]);
        echo ('</pre></center>');
        return ob_get_clean();
    }
    return ob_get_clean();
}