<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <TITLE>@pageTitl@</TITLE>
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <META name="description" content="@pageDesc@">
        <META name="keywords" content="@pageKeyw@">
        <META name="copyright" content="@pageReg@">
        <META name="engine-copyright" content="PHPSHOP.RU, @pageProduct@">
        <META name="domen-copyright" content="@pageDomen@">
        <META content="General" name="rating">
        <META name="ROBOTS" content="ALL">
        <LINK rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <LINK rel="icon" href="favicon.ico" type="image/x-icon">
        <LINK href="@pageCss@" type="text/css" rel="stylesheet">
        <SCRIPT language="JavaScript" src="java/phpshop.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="java/swfobject.js"></SCRIPT>
    </HEAD>
    <BODY onload="default_load('false', 'false');
            NavActive('index');
            LoadPath('@ShopDir@');">
        <table width="1004" cellpadding="0" cellspacing="0" align="center">
            <tr>
                <td>
                    <div id="cartwindow" class="message">
    <div class="ico_add_to_card"><b>��������...</b><br>����� �������� � �������</div>
</div>
<div id="comparewindow" class="message">
    <div class="ico_add_to_compare"><b>��������...</b><br>����� �������� � ���������</div>
</div>

                    <TABLE WIDTH="1004" BORDER="0" CELLPADDING="0" CELLSPACING="0">
                        <TR>
                            <TD COLSPAN="2" id="header_1">
                                <img src="@logo@" alt="@name@" border="0" alt="@name@">
                            </TD>
                            <TD COLSPAN="2" id="header_2" valign="top">
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN="4" id="header_3">

                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td id="index"><a href="/"  class="navigation" style="font-weight: bold;text-decoration: none;">�������</a></td>
                                        <td style="padding-top:1px;padding-left:5px;padding-right:5px" width="30" align="center"><img src="images/menu_spek.gif" alt="" width="5" height="20" border="0" align="absmiddle"></td>

                                        @topMenu@
                                    </tr>
                                </table>



                            </TD>
                        </TR>
                        <TR>
                            <TD id="header_4">
                                <div style="padding-top:5px;padding-left:10px">
                                    <table >
                                        <FORM method="post" name="forma_search" action="/search/" onsubmit="return SearchChek()">
                                            <tr>
                                                <td colspan="2"><b class="zagb">����� �� ��������</b></td>
                                            </tr>
                                            <tr>
                                                <td><input name="words" class="search" maxLength=30 onfocus="this.value = ''" value="� ���..."></td>
                                                <td><input type="submit" value="������" class="but"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="/search/" >+ ����������� �����</a>
                                                </td>
                                            </tr>
                                        </FORM>
                                    </table>
                                </div>


                            </TD>
                            <TD COLSPAN="2" id="header_5">

                                <div style="padding-bottom:5px" class="zagb">�������</div>
                                <TABLE cellspacing="0" cellpadding="0">
                                    <TR>
                                        <TD class="white">������� :&nbsp;&nbsp;

                                        </TD>
                                        <td class="white">
                                            <DIV class="style2" id="num" style="DISPLAY: inline; FONT-WEIGHT: bold">    @num@
                                            </DIV>&nbsp;��. 
                                        </td>


                                    </TR>
                                    <TR>
                                        <TD class="white">����� ������ :&nbsp;&nbsp;

                                        </TD>
                                        <td class="white">
                                            <DIV class="style2" id="sum" style="DISPLAY: inline; FONT-WEIGHT: bold">    @sum@ @productValutaName@
                                            </DIV>
                                        </td>

                                    </TR>
                                    <TR>
                                        <TD class="white">��������� :&nbsp;&nbsp;

                                        </TD>
                                        <td class="white">
                                            <DIV class="style2" id="numcompare" style="DISPLAY: inline; FONT-WEIGHT: bold"> @numcompare@
                                            </DIV>&nbsp;��. 
                                        </td>

                                    </TR>
                                </TABLE>
                                <table>
                                    <tr>
                                        <td>@valutaDisp@</td>
                                        <td>  <div id="order" style="display:@orderEnabled@; padding-left:20px"><A href="/order/" style=" font-weight: bold;">�������� �����</A></div>

                                            <div id="compare" style="padding-left:20px;padding-top:5px;display:@compareEnabled@" ><a href="/compare/" title="��������� �������"  style="font-weight: bold;">�������� ������</div>


                                        </td>
                                    </tr>
                                </table>


                            </TD>
                            <TD id="header_6">
                                <a id="userPage"></a>
                                <div style="padding-bottom:5px" class="zagb">�������������</div>
                                @usersDisp@

                            </TD>
                        </TR>
                        <TR>
                            <TD>
                                <IMG SRC="images/spacer.gif" WIDTH=408 HEIGHT=1 ALT=""></TD>
                            <TD>
                                <IMG SRC="images/spacer.gif" WIDTH=181 HEIGHT=1 ALT=""></TD>
                            <TD>
                                <IMG SRC="images/spacer.gif" WIDTH=94 HEIGHT=1 ALT=""></TD>
                            <TD>
                                <IMG SRC="images/spacer.gif" WIDTH=321 HEIGHT=1 ALT=""></TD>
                        </TR>
                    </TABLE>
                    <table width="1004" BORDER="0" CELLPADDING="0" CELLSPACING="0" style="margin-top:20px">
                        <tr>
                            <td width="2"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
                            <td width="275"  valign="top" class="left_block"><img src="images/spacer.gif" alt="" width="275" height="1" border="0">@skinSelect@
                                <div id="bg_catalog_1">������� ���������</div>
                                @leftCatal@
                                <a href="/news/"><DIV class=catalog_forma style="CURSOR: pointer" onclick="javascript:location.replace('/news/')"><TABLE cellSpacing=0 cellPadding=0 width=275 border=0>
                                            <TBODY>
                                                <TR>
                                                    <TD style="PADDING-LEFT: 62px; FONT-WEIGHT: bold; PADDING-TOP: 15px">�������</TD></TR></TBODY></TABLE></DIV></a>
                                <a href="/gbook/"><DIV class=catalog_forma style="CURSOR: pointer" onclick="javascript:location.replace('/gbook/')"><TABLE cellSpacing=0 cellPadding=0 width=275 border=0>
                                            <TBODY>
                                                <TR>
                                                    <TD style="PADDING-LEFT: 62px; FONT-WEIGHT: bold; PADDING-TOP: 15px">������</TD></TR></TBODY></TABLE></DIV></a>
                                <a href="/price/"><DIV class=catalog_forma style="CURSOR: pointer" onclick="javascript:location.replace('/price/')"><TABLE cellSpacing=0 cellPadding=0 width=275 border=0>
                                            <TBODY>
                                                <TR>
                                                    <TD style="PADDING-LEFT: 62px; FONT-WEIGHT: bold; PADDING-TOP: 15px">�����-����</TD></TR></TBODY></TABLE></DIV></a>
                                @pageCatal@
                                @leftMenu@
                                @oprosDisp@
                                @cloud@
                            </td>
                            <td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
                            <td width="100%" valign="top">
                            
                                <div id="bg_catalog_1">@mainContentTitle@</div>
                                <div id="bglist"></div>
                                <table width="100%">
                                    <tr>
                                        <td>
                                            @mainContent@
                                        </td>
                                    </tr>
                                </table>
                                <div id="bg_catalog_1">���������������</div>
                                <div id="bglist"></div>
                                <table width="100%">
                                    <tr>
                                        <td>
                                            @specMain@
                                            <div align="center" id="allspec" >
                                                <img src="images/accept.gif" alt="" width="16" height="16" border="0" align="absmiddle">
                                                <a href="/newprice/">��� ����������</a>
                                                &nbsp;&nbsp;
                                                <img src="images/accept.gif" alt="" width="16" height="16" border="0" align="absmiddle">
                                                <a href="/newtip/">��� �������</a>
                                                &nbsp;&nbsp;
                                                <img src="images/accept.gif" alt="" width="16" height="16" border="0" align="absmiddle">
                                                <a href="/spec/">��� ���������������</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <p></p>
                                <div id="bg_catalog_1">������ ��������</div>
                                <div id="bglist"></div>
                                @nowBuy@

                                @banersDisp@
                                <div id="bg_catalog_1">��������� �������</div>
                                <div id="bglist"></div>
                                @miniNews@
                                <div align="center" id="allspec" >
                                    <img src="images/accept.gif" alt="" width="16" height="16" border="0" align="absmiddle">
                                    <a href="/news/">����� ��������</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td height="30" colspan="3"></td>
                        </tr>
                    </table>
                    <table width="1004" BORDER="0" CELLPADDING="0" CELLSPACING="0">
                        <tr>
                            <td id="bg_footer_2" width="100%">
                                Copyright &copy; @pageReg@.<br>
                                ��� ����� ��������. ���. @telNum@<br>
                                <img src="images/feed.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/rss/" title="RSS">RSS</a> | 
                                <img src="images/shop/sitemap.gif" alt="" width="16" height="16" border="0" align="absmiddle">
                                <a href="/map/" title="����� �����">����� �����</a> 
                            </td>
                            <td id="bg_footer_3" width="174">

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table><br><div align="center">@button@</div>