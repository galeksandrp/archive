<div id="bg_catalog_1">�����-����</div>
<div id="bglist"></div>



	<TABLE  width="100%" cellpadding="0" cellspacing="0">
		<TR bgcolor="#ffffff">
			<TD width="100%" align="left">
				<TABLE width="100%" cellpadding="5" cellspacing="0">
					<TR>
						<TD>
							<TABLE cellpadding="0" cellspacing="0" width="100%" class="style5">
								<TR>
									<TD>
										<TABLE width="100%">
											<TR>
												<TD class="black" style="padding:10">	
<form>
@searchPageCategory@	<input type="button" value="��������" onclick="DoPriceSort();">
</form>

<div style="padding-top:10px">

<table>
<tr>
	<td width="150">
	<img src="images/shop/zoom.gif" alt="" border="0" align="absmiddle" hspace="5">
    <a href="/price/CAT_ALL.html" title="������� ��� �������">������� ��� �������</a>
	</td>
	<td width="150">
	<img src="images/shop/layout_content.gif" alt="" border="0" align="absmiddle" hspace="5">
    <a href="javascript:GetAllForma('@PageCategory@')" title="����� � ���������">����� � ���������</a>
	</td>
	<td>
    <img border=0 align=absmiddle hspace=3 vspace=3 src="images/shop/action_print.gif">
	<a href="#" onclick="window.open('phpshop/forms/priceprint/print.html?catId=@PageCategory@')" title="�������� �����">�������� �����</a>
	</td>
</tr>
<tr>
	<td width="100">
	<img border=0 align=absmiddle hspace=3 vspace=3 src="images/shop/action_save.gif">
	<a href="#" onclick="window.open('/files/priceSave.php?catId=@PageCategory@')" title="Excel �����">Excel �����</a>
	</td>
	<td>
	<img border=0 align=absmiddle hspace=3 vspace=3 src="images/shop/package.gif">
	<a href="#" onclick="window.open('/files/priceSave.php?catId=@PageCategory@&gzip=true')" title="Excel ����� GZIP">Excel ����� GZIP</a>
	</td>
	<td>
	<img border=0 align=absmiddle hspace=3 vspace=3 src="images/shop/basket_add.gif">
    <a href="/files/onlineprice/" target="_blank" title="������������� �����">������������� �����</a>
    </td>
</tr>
</table>




</div>
								
												</TD>
											</TR>
										</TABLE>
									</TD>
								</TR>
								<TR>
									<TD>	
									@productPageDis@
									</TD>
								</TR>
								
							</TABLE>
						</TD>
				</TABLE>
			</TD>
		</TR>
	</TABLE>