<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>�������� ������ �������������</title>
        <META http-equiv=Content-Type content="text/html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0" >
        <form name="product_edit"  method=post>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
                <tr bgcolor="#ffffff">
                    <td style="padding:10">
                        <b><span name=txtLang id=txtLang>�������� ����� ������</span></b><br>

                    </td>
                    <td align="right">
                        <img src="../img/i_billing_history_med[1].gif" border="0" hspace="10">
                    </td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
                <tr>
                    <td colspan="2">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>�����������</span> </LEGEND>
                            <div style="padding:10">
                                <input type="text" name="name_new" class="full" value="<?= $name ?>">
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>�������</span></LEGEND>
                            <div style="padding:10">
                                <textarea class=full name=description_new style="height:40px"><?= $description ?></textarea>
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                <tr>
                    <td>
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>������</span> </LEGEND>
                            <div style="padding:10">
                                <input type="text" size="3" name="num_new" value="<?= $num ?>">
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
            </table>
            <hr>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                <tr> 
                    <td align="left" style="padding:10">
                        <BUTTON class="help" onclick="helpWinParent('sort_groupID')">�������</BUTTON>
                    </td>
                    <td align="right" style="padding:10">
                        <input type="submit" name="editID" value="OK" class=but>
                        <input type="reset" name="btnLang" class=but value="��������">
                        <input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
                    </td>
                </tr>
            </table>
        </form>
        <?
        if (isset($editID) and !empty($name_new)) {// ������ ��������������
            if (CheckedRules($UserStatus["cat_prod"], 2) == 1) {

                $sql = "INSERT INTO " . $SysValue['base']['table_name20'] . " VALUES ('','$name_new','$num_new','0','0','$description_new','0','0','','')";
                $result = mysql_query($sql) or @die("" . mysql_error() . "");
                echo"
	  <script>
DoReloadMainWindow('sort_group');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        ?>



