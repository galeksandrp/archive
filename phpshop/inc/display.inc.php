<?php

/**
 * ��������� �� �������
 * @package PHPShopCoreDepricated
 * @param string $allcats �� �������������� ���������
 * @param bool $flagger ��������
 * @return string
 */
function DispNav($allcats="",$flagger=0) {
    global $SysValue,$LoadItems;

    // ���-�� �������, ����� ���� �����
    $nav_len=3;
    $sort=null;
    $navigat=null;

    $id=TotalClean($SysValue['nav']['id'],1);
    $v=$SysValue['nav']['query']['v'];
    $p=$SysValue['nav']['page'];
    if(empty($p) and empty($_POST['priceSearch'])) $p=1;

    // ������ ������� ����
    if(!empty($SysValue['nav']['querystring']))
        $querystring="?".$SysValue['nav']['querystring'];
    else $querystring="";

    // ��� ��������
    if($p=="ALL" or isset($_POST['priceSearch']))
        $productSortD="sortActiv";
    else $p=TotalClean($p,1);

    // ���������� �� ���������������
    if(is_array($v)) {
        foreach($v as $key=>$value) {
            $hash=$key."-".$value;
            $sort.=" and vendor REGEXP 'i".$hash."i'";
        }
    }

    // ��� ������� ��������
    if($LoadItems['Catalog'][$id]['num_cow']>0)
        $num_row=$LoadItems['Catalog'][$id]['num_cow'];
    else $num_row=$LoadItems['System']['num_row'];

    if ($flagger) {
        $catt='';
        $catt1='';
        foreach ($allcats as $nn) {
            $catt.=",".$nn;
            $catt1.= " OR dop_cat LIKE '%#$nn#%' ";
        }
        $catt=substr($catt,1);
        $catt='(category IN ('.$catt.') '.$catt1.')';
    } else {
        $catt='(category='.$id.' OR dop_cat LIKE \'%#'.$id.'#%\')';
    }


    if(empty($v))
        $num_page=NumFrom("table_name2","where $catt and enabled='1' and parent_enabled='0' ".$user);
    else
        $num_page=NumFrom("table_name2","where $catt and enabled='1' and parent_enabled='0' ".$sort.$user);


    $i=1;
    $num=$num_page/$num_row;
    while ($i<$num+1) {
        if($i!=$p) {

            if($i==1) $pageOt=0+@$pageDo;
            else $pageOt=$i+@$pageDo-$i;

            $pageDo=$i*$num_row;

            if($i>($p-$nav_len) and $i<($p+$nav_len))
                $navigat.="
	     <a href=\"./CID_".$id."_".$i.".html".$querystring."\">".($pageOt+1)."-".$pageDo."</a> | ";
            else if($i-($p+$nav_len)<3 and (($p-$nav_len)-$i)<3) @$navigat.=".";

        }
        else {

            if($i==1) $pageOt=0+@$pageDo;
            else $pageOt=$i+@$pageDo-$i;

            $pageDo=$i*$num_row;
            $navigat.="
	     <b>".($pageOt+1)."-".$pageDo."</b> | ";
        }
        $i++;
    }
    if($num>1) {
        if($p>=$num) {
            $p_to=$i-1;
        }else {
            $p_to=$p+1;
        }
        $nava=$SysValue['lang']['page_now'].":
<a href=\"./CID_".$id."_".($p-1).".html".$querystring."\" title=\"�����\"><img src=\"images/shop/3.gif\" width=\"16\" height=\"15\" border=\"0\" align=\"absmiddle\"></a>
                $navigat<a href=\"./CID_".$id."_".$p_to.".html".$querystring."\"><img src=\"images/shop/4.gif\" width=\"16\" height=\"15\" border=\"0\" align=\"absmiddle\" title=\"������\"></a>
&nbsp;&nbsp;
<a href=\"./CID_".$id."_ALL.html".$querystring."\" class=\"$productSortD\">��� �������</a>
                ";
    }
    return $nava;
}


/**
 * ������ � ��
 * @package PHPShopCoreDepricated
 * @param int $n �� ��������
 * @param bool $flagger ��������
 * @return string
 */
function PageDisp($n,$flagger=0) {
    global $SysValue,$LoadItems;
    $sort=null;

    $sort="";
    if (!$flagger) {
        $n=TotalClean($n,1);
    }

    $p=$SysValue['nav']['page'];
    if(empty($p)) $p=1;

    $v=$SysValue['nav']['query']['v'];
    $s=TotalClean($SysValue['nav']['query']['s'],1);
    $f=TotalClean($SysValue['nav']['query']['f'],1);

    if($p!="ALL")
        $p=TotalClean($p,1);

    if(@$LoadItems['Podcatalog'][$n]['num_cow']>0)
        $num_row=$LoadItems['Podcatalog'][$n]['num_cow'];
    else $num_row=$LoadItems['System']['num_row'];
    $num_ot=0;
    $q=0;

    // ���������� �� ���������������
    if(is_array($v)) {
        foreach($v as $key=>$value) {
            $hash=$key."-".$value;
            $sort.=" and vendor REGEXP 'i".$hash."i' ";
        }
    }

    // ���������� �����������
    switch(@$LoadItems['Podcatalog'][$n]['order_by']) {
        case(1): $cat_order="order by name";
            break;
        case(2): $cat_order="order by price";
            break;
        case(3): $cat_order="order by num";
            break;
        default: $cat_order="order by num";
    }
    switch(@$LoadItems['Podcatalog'][$n]['order_to']) {
        case(1): $cat_order_to="";
            break;
        case(2): $cat_order_to=" desc";
            break;
        default: $cat_order_to="";
    }

    // ����������
    switch($s) {
        case(1): $string.="order by name";
            break;
        case(2): $string.="order by price";
            break;
        case(3): $string.="order by num";
            break;
        default: $string.=$cat_order;
    }



    // ���������� �����������
    switch($f) {
        case(1): $string.="";
            break;
        case(2): $string.=" desc";
            break;
        default: $string.=$cat_order_to;
    }

    // �������������� ���������
    if ($flagger) {
        $catt='';
        $catt1='';
        foreach ($n as $nn) {
            $catt.=",".$nn;
            $catt1.= " OR dop_cat LIKE '%#$nn#%' ";
        }
        $catt=substr($catt,1);
        $catt='(category IN ('.$catt.') '.$catt1.')';
    } else {
        $catt='(category='.$n.' OR dop_cat LIKE \'%#'.$n.'#%\')';
    }


    // ��� ��������
    if($p=="ALL") {
        $sql="select * from ".$SysValue['base']['table_name2']." where ($catt and enabled='1' and parent_enabled='0') ".$sort." ".$string;
    }

    // ����� �� ����
    elseif(!empty($_POST['priceSearch'])) {
        $priceOT=TotalClean($_POST['priceOT'],1);
        $priceDO=TotalClean($_POST['priceDO'],1);

        // �������������
        if($priceDO==0) $priceDO=1000000000;

        if(empty($priceOT)) $priceOT=0;

        $priceOT=GetPriceSort($priceOT,0);
        $priceDO=GetPriceSort($priceDO,0);
        $sql="select * from ".$SysValue['base']['table_name2']." where $catt and enabled='1' and parent_enabled='0' and price >= ".($priceOT/(100+$LoadItems['System']['percent'])*100)." AND price <= ".($priceDO/(100+$LoadItems['System']['percent'])*100)." ".$string;
    }
    else while($q<$p) {
            $sql="select * from ".$SysValue['base']['table_name2']." where $catt and enabled='1' and parent_enabled='0' $sort ".$string." LIMIT $num_ot, $num_row";
            $q++;
            $num_ot=$num_ot+$num_row;
        }
    $SysValue['sql']['num']++;

    return $sql;
}


/**
 * ����� �������� ��������
 * @package PHPShopCoreDepricated
 * @param int $category �� ���������
 * @return string
 */
function DispCatContent($category) {
    global $SysValue,$LoadItems;

    $sql="select content from ".$SysValue['base']['table_name']." where id=$category";
    $result=mysql_query($sql);
    $SysValue['sql']['num']++;

    $row = mysql_fetch_array($result);
    $content = $row['content'];

    // ����� Multibase
    $admoption=unserialize($LoadItems['System']['admoption']);
    if($admoption['base_enabled'] == 1 and !empty($admoption['base_host']))
        $content=eregi_replace("/UserFiles/","http://".$admoption['base_host']."/UserFiles/",$row['content']);

    return $content;
}


/**
 * ����� �������� �������� ������� � ��������
 * @package PHPShopCoreDepricated
 * @param int $n �� ��������
 * @param bool $flagger ��������� �������������� ��������
 * @param string $pcatal
 * @return string
 */
function DispKratko($n,$flagger=0,$pcatal="") {
    global $SysValue,$LoadItems;

    $disp=null;
    $j=0;
    $disL=null;
    $p=$SysValue['nav']['page'];
    $v=TotalClean($SysValue['nav']['query']['v'],1);
    $s=TotalClean($SysValue['nav']['query']['s'],1);
    $f=TotalClean($SysValue['nav']['query']['f'],1);
    if(empty($p)) $p=1;

    if (empty($flagger)) {
        $n=TotalClean($n,1);
    }

    if($p!="ALL")
        $p=TotalClean($p,1);

    // ������ � ��
    $sql=PageDisp($n,$flagger);

    if ($flagger) {
        $allcats=$n;
        $n=$pcatal;
    }

    $result=mysql_query($sql);
    $SysValue['sql']['num']++;
    $num_rows=mysql_num_rows($result);

    $i=0;

    // ���� �� ������ ���-�� �����
    if(empty($LoadItems['Podcatalog'][$n]['num_row'])) $LoadItems['Podcatalog'][$n]['num_row']=2;

    $SysValue['my']['setka_num']=$LoadItems['Podcatalog'][$n]['num_row'];
    $setka_num=$LoadItems['Podcatalog'][$n]['num_row'];
    if($SysValue['my']['setka_num'] == 2) $j=0;
    if($SysValue['my']['setka_num'] == 3) $j=1;
    if($SysValue['my']['setka_num'] == 4) {
        $j=1;
        $setka_num=3;
    }

    while(@$row = mysql_fetch_array($result)) {
        $id=$row['id'];
        $uid=$row['uid'];
        $name=stripslashes($row['name']);
        $category=$n;
        $description=stripslashes($row['description']);
        $vendor=$row['vendor'];
        $vendor_array=$row['vendor_array'];
        $sklad=$row['sklad'];
        $items=$row['items'];
        $baseinputvaluta=$row['baseinputvaluta'];
        $price=$row['price'];
        $price = ($price+(($price*$LoadItems['System']['percent'])/100));

        if(empty($row['ed_izm'])) $ed_izm = "��.";
        else $ed_izm = $row['ed_izm'];

        // ������� �� ���� ������ ������� ����
        if(session_is_registered('UsersStatus')) {
            $GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
            if($GetUsersStatusPrice>1) {
                $pole="price".$GetUsersStatusPrice;
                $pricePersona=$row[$pole];
                if(!empty($pricePersona))
                    $price=($pricePersona+(($pricePersona*$LoadItems['System']['percent'])/100));
            }
        }

        if ($flagger) {
            $LoadItems['Product'][$id]['pic_small']=$row['pic_small'];
            $LoadItems['Product'][$id]['pic_big']=$row['pic_big'];
            $LoadItems['Product'][$id]['price']=$price;
            $LoadItems['Product'][$id]['priceNew']=$row['price_n'];
        }

        // ����� �������������� � ������� ��������
        //$SysValue['other']['vendorDisp']=DispCatSortTable($category,$vendor_array);

        // ����� Multibase
        $admoption=unserialize($LoadItems['System']['admoption']);
        if($admoption['base_enabled'] == 1 and !empty($admoption['base_host']))
            $LoadItems['Product'][$id]['pic_small']=eregi_replace("/UserFiles/","http://".$admoption['base_host']."/UserFiles/",$LoadItems['Product'][$id]['pic_small']);

        // ������ ��������
        if(empty($LoadItems['Product'][$id]['pic_small']))
            $LoadItems['Product'][$id]['pic_small']="images/shop/no_photo.gif";

        // ���������� ����������
        $SysValue['other']['productSale']= $SysValue['lang']['product_sale'];
        $SysValue['other']['productInfo']= $SysValue['lang']['product_info'];
        $SysValue['other']['productName']= $name;
        $SysValue['other']['productArt']= $uid;
        $SysValue['other']['productDes']= $description;
        $SysValue['other']['productValutaName']= GetValuta();
        $SysValue['other']['productImg']= $LoadItems['Product'][$id]['pic_small'];
        $SysValue['other']['productImgBigFoto']= $LoadItems['Product'][$id]['pic_big'];

        // ���������� ��������� ������
        if($admoption['sklad_enabled'] == 1 and $items>0)
            $SysValue['other']['productSklad']= $SysValue['lang']['product_on_sklad']." ".$items." ".$ed_izm;
        else $SysValue['other']['productSklad']="";

        // ���� ����� �� ������
        if($sklad==0) {

            $SysValue['other']['Notice']="";
            $SysValue['other']['ComStartCart']="";
            $SysValue['other']['ComEndCart']="";
            $SysValue['other']['ComStartNotice']="<!--";
            $SysValue['other']['ComEndNotice']="-->";

            // ���� ��� ����� ����
            if(empty($LoadItems['Product'][$id]['priceNew'])) {
                $SysValue['other']['productPrice']=GetPriceValuta(ReturnTruePriceUser($id,$LoadItems['Product'][$id]['price']),"",$baseinputvaluta);
                $SysValue['other']['productPriceRub']= "";
            }else {// ���� ���� ����� ����
                $SysValue['other']['productPrice']=GetPriceValuta(ReturnTruePriceUser($id,$LoadItems['Product'][$id]['price']),"",$baseinputvaluta);
                $SysValue['other']['productPriceRub']= "<strike>".GetPriceValuta($LoadItems['Product'][$id]['priceNew'],"",$baseinputvaluta)." ".GetValuta()."</strike>";
            }
        }else { // ����� ��� �����
            $SysValue['other']['productPrice']=GetPriceValuta(ReturnTruePriceUser($id,$LoadItems['Product'][$id]['price']),"",$baseinputvaluta);
            $SysValue['other']['productPriceRub']=$SysValue['lang']['sklad_mesage'];
            $SysValue['other']['ComStartNotice']="";
            $SysValue['other']['ComEndNotice']="";
            $SysValue['other']['ComStartCart']="<!--";
            $SysValue['other']['ComEndCart']="-->";
            $SysValue['other']['productNotice']=$SysValue['lang']['product_notice'];
        }

        $SysValue['other']['productId']= $LoadItems['Product'][$id]['category'];
        $SysValue['other']['productPageThis']=$p;
        $SysValue['other']['productUid']= $id;

// �������
        /*
if($row['parent']!=""){
$SysValue['other']['ComStart']="<!--";
$SysValue['other']['ComEnd']="-->";
$SysValue['other']['ComStartCart']="<!--";
$SysValue['other']['ComEndCart']="-->";
}else{
$SysValue['other']['ComStart']="";
$SysValue['other']['ComEnd']="";
}
        */


        // ���� ���� ���������� ������ ����� ����������
        if($admoption['user_price_activate']==1 and !$_SESSION['UsersId']) {
            $SysValue['other']['ComStartCart']="<!--";
            $SysValue['other']['ComEndCart']="-->";
            $SysValue['other']['productPrice']="";
            $SysValue['other']['productValutaName']="";
        }

        // ����� ����� ��� �������
        $DispCatOptionsTest=DispCatOptionsTest($category);
        if($DispCatOptionsTest == 1) {
            $SysValue['other']['ComStartCart']="<!--";
            $SysValue['other']['ComEndCart']="-->";
        }

        // ���������� ������ ������������� �� �����
        $dis=ParseTemplateReturn($SysValue['templates']['main_product_forma_'.$setka_num]);


        // ����� 1*1
        if($SysValue['my']['setka_num'] == 1) {

            $td="<tr><TD class=setka colspan=3 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
            $td.="<tr><td valign=\"top\">";
            $j++;
            $td2="</td>";

            $disp.=$td.$dis;
        }


        // ����� 2*2
        if($SysValue['my']['setka_num'] == 2) {

            if($j==1) {
                $td="<td valign=\"top\" class=\"panel_r\">";
                $j=0;
                $td2="</td>";
            }
            else {
                $td="<tr><TD class=setka colspan=3 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
                $td.="<tr><td valign=\"top\" class=\"panel_l\">";
                $j++;
                $td2="</td>";
                $td2.="<TD width=1 class=setka><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
            }
            $disp.=$td.$dis.$td2;
        }


        // ����� 3*3
        if($SysValue['my']['setka_num'] == 3) {
            if($j==3) {
                $td="<td  valign=\"top\" class=\"panel_t\">";
                $j++;
                $td2="</td></tr>";
                $disp.=$td.$dis.$td2;
            }

            if($j==2) {
                $td="<td  valign=\"top\" class=\"panel_t\">";
                $j++;
                $td2="</td>";
                $td2.="<TD width=1 class=\"setka\"><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
                $disp.=$td.$dis.$td2;
            }

            if($j==1) {
                $td="<tr><TD width=100% class=\"setka\" colspan=5 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
                $td.="<tr><td  valign=\"top\" class=\"panel_t\">";
                $j++;
                $td2="</td>";
                $td2.="<TD width=1 class=\"setka\"><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
                $disp.=$td.$dis.$td2;
            }

            if($j==4) {
                $j=1;
            }
        }


        // ����� 4*4
        if($SysValue['my']['setka_num'] == 4) {

            if($j==4) {
                $td="<td  valign=\"top\" class=\"panel_f\">";
                $j++;
                $td2="</td></tr>";
                $disp.=$td.$dis.$td2;
            }

            if($j==3) {
                $td="<td  valign=\"top\" class=\"panel_f\">";
                $j++;
                $td2="</td>";
                $td2.="<TD width=1 class=\"setka\"><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
                $disp.=$td.$dis.$td2;
            }

            if($j==2) {
                $td="<td  valign=\"top\" class=\"panel_f\">";
                $j++;
                $td2="</td>";
                $td2.="<TD width=1 class=\"setka\"><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
                $disp.=$td.$dis.$td2;
            }

            if($j==1) {
                $td="<tr><TD width=100% class=\"setka\" colspan=5 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
                $td.="<tr><td  valign=\"top\" class=\"panel_f\">";
                $j++;
                $td2="</td>";
                $td2.="
<TD width=1 class=\"setka\"><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
                $disp.=$td.$dis.$td2;
            }

            if($j==5) {
                $j=1;
            }
        }
    }

    // ���������� ����������
    $SysValue['other']['catalog']= $SysValue['lang']['catalog'];
    $SysValue['other']['vendorDisp']=DispCatSort($n);

    $v_ids=null;
    if(!empty($SysValue['other']['vendorDisp'])) {
        if(is_array($SysValue['sort']))
            foreach($SysValue['sort'] as $value)
                $v_ids.=$value.",";
        $len=strlen($v_ids);
        $v_ids=substr($v_ids,0,$len-1);
        $SysValue['other']['vendorSelectDisp']="<input type=\"button\" value=\"���������\" onclick=\"GetSortAll(".$SysValue['nav']['id'].",".$v_ids.")\" class=\"ok\"> <A title=\"�������� ��� �������, �������� ��� ������ �������\" href=\"?\" class=b>�������� ��� �������</a>";
        $SysValue['other']['vendorDispTitle']="<div><B>������ �������</B></div>";
    }
    $cat=$LoadItems['Podcatalog'][$n]['parent_to'];

    if($cat == 0) {
        $SysValue['other']['catalogCat']= $SysValue['lang']['catalog'];
        $SysValue['other']['catalogId']="00";
    }
    else {
        $SysValue['other']['catalogCat']= $LoadItems['Catalog'][$cat]['name'];
        $SysValue['other']['catalogId']= $cat;
    }

    $SysValue['other']['catalogCategory']=$LoadItems['Podcatalog'][$n]['name'];
    $SysValue['other']['producFound']= $SysValue['lang']['found_of_products'];
    $SysValue['other']['productPodcat']=$category;
    $SysValue['other']['pcatalogId']= $LoadItems['Podcatalog'][$category]['id'];
    $SysValue['other']['productPodcatId']=$LoadItems['Podcatalog'][$category]['parent_to'];
    $SysValue['other']['productId']=$n;

    // ��������� ������������
    $podcatalog_id = array_keys($LoadItems['CatalogKeys'],$cat);

    foreach($podcatalog_id as $key) {
        if($key == $n)
            $disL.="<a href=\"/shop/CID_$key.html\" class=\"activ_catalog\">".$LoadItems['Catalog'][$key]['name']."</a> | ";
        else
            $disL.="<a href=\"/shop/CID_$key.html\" title=\"".$LoadItems['Catalog'][$key]['name']."\">".$LoadItems['Catalog'][$key]['name']."</a> | ";
    }
    if(count($podcatalog_id)) $disp_list="<h2>".$SysValue['other']['catalogCat']."</h2>$disL";


    $SysValue['other']['DispCatNav'] = $disp_list;
    $SysValue['other']['catalogContent'] = DispCatContent($n);

    // ����������� ����������
    switch($f) {
        case(1):
            $SysValue['other']['productSortNext']=2;
            $SysValue['other']['productSortImg']=1;
            $SysValue['other']['productSortTo']=1;
            break;
        case(2):
            $SysValue['other']['productSortNext']=1;
            $SysValue['other']['productSortImg']=2;
            $SysValue['other']['productSortTo']=2;
            break;
        default:
            $SysValue['other']['productSortNext']=2;
            $SysValue['other']['productSortImg']=1;
            $SysValue['other']['productSortTo']=1;
    }

    switch($LoadItems['Podcatalog'][$n]['order_by']) {
        case(1): $cat_order="productSortA";
            break;
        case(2): $cat_order="productSortB";
            break;
        case(3): $cat_order="productSortC";
            break;
        default: $cat_order="productSortC";
    }


    switch($s) {
        case(1):
            $SysValue['other']['productSortA']="sortActiv";
            $SysValue['other']['productSort']=1;
            break;
        case(2):
            $SysValue['other']['productSortB']="sortActiv";
            $SysValue['other']['productSort']=2;
            break;
        case(3):
            $SysValue['other']['productSortC']="sortActiv";
            $SysValue['other']['productSort']=3;
            break;
        case(4):
            $SysValue['other']['productSortD']="sortActiv";
            $SysValue['other']['productSort']=4;
            break;
        default:
            $SysValue['other']['productSort']=$LoadItems['Podcatalog'][$n]['order_by'];
            $SysValue['other'][$cat_order]="sortActiv";
    }


    if(empty($v)) {
        //$SysValue['other']['productNum']= $LoadItems['Podcatalog'][$category]['num'];
        $SysValue['other']['productVendor']= "";
    }
    else {
        //$SysValue['other']['productNum']= NumFrom("table_name2","where category=$category and vendor=$v");
        $SysValue['other']['productVendor']= $v;
    }

    // ���������� �� ����
    $SysValue['other']['productRriceOT']=TotalClean($_POST['priceOT'],1);
    $SysValue['other']['productRriceDO']=TotalClean($_POST['priceDO'],1);

    if($LoadItems['Podcatalog'][$n]['num_cow']>0)
        $SysValue['other']['productNumRow']=$LoadItems['Podcatalog'][$n]['num_cow'];
    else $SysValue['other']['productNumRow']=$LoadItems['System']['num_row'];


    $SysValue['other']['productPage']=$SysValue['lang']['page_now'];

    if ($flagger) {
        $SysValue['other']['productPageNav']=DispNav($allcats,1);
    } else {
        $SysValue['other']['productPageNav']=DispNav();
    }

    if($num_rows>0) $SysValue['other']['productPageDis']=$disp;
    else $SysValue['other']['productPageDis']="<DIV style=\"padding:10px\"><h2>������� ���������� ���� ������� ��� � �������</h2></DIV>";

    // ���������� ������
    if(!empty($LoadItems['Podcatalog'][$n]['name']))
        $disp=ParseTemplateReturn($SysValue['templates']['product_page_list']);
    else
        $disp=404;

    if ($flagger) {
        $disp=ParseTemplateReturn($SysValue['templates']['product_page_list_2']);
    }

    return $disp;
}

/**
 * ����� ������������ ������
 * @package PHPShopCoreDepricated
 * @param int $id �� ������
 * @return string
 */
function DispProductPage($id) {
    global $SysValue,$LoadItems;

    $dis=null;
    foreach($LoadItems['Product'][$id]['page'] as $val) {

        // ���������� ���������
        $Open_from_base=Open_from_base($val);
        $SysValue['other']['pageLink']=$Open_from_base[2];
        $SysValue['other']['pageName']=$Open_from_base[0];

        // ���������� ������
        $dis.=ParseTemplateReturn($SysValue['templates']['product_pagetema_forma']);
    }

    return $dis;
}

/**
 * ����� �������� �������� �������
 * @package PHPShopCoreDepricated
 * @param int $n �� ��������
 * @return string
 */
function ReturnCatalogData($n) {
    global $SysValue;

    $n=TotalClean($n,1);
    $sql="select id,name,parent_to from ".$SysValue['base']['table_name']." where id=$n";
    $result=mysql_query($sql);
    @$row = mysql_fetch_array(@$result);
    $id=$row['id'];
    $name=$row['name'];
    $parent_to=$row['parent_to'];

    $array=array(
            "id"=>$n,
            "name"=>$name,
            "parent_to"=>$parent_to
    );

    $SysValue['sql']['num']++;
    return $array;
}


/**
 * ������ �� ������
 * @package PHPShopCoreDepricated
 * @param int $n �� ������
 * @param bool $flag �������� ������� [1,2,false]
 * @return array
 */
function ReturnProductData($n,$flag=1) {
    global $SysValue,$LoadItems;

    switch($flag) {
        case(1):
            $sql="select * from ".$SysValue['base']['table_name2']." where id=$n and (enabled='1' and sklad != '1')";
            break;
        case(2):
            $sql="select * from ".$SysValue['base']['table_name2']." where uid='$n' and (enabled='1' and sklad != '1')";
            break;
        default:
            $sql="select * from ".$SysValue['base']['table_name2']." where id=$n and enabled='1'  ";
    }

    $result=mysql_query($sql);
    @$row = mysql_fetch_array(@$result);

    $name=stripslashes($row['name']);
    $id=$row['id'];
    $uid=$row['uid'];
    $category=$row['category'];
    $description=stripslashes($row['description']);
    $price=$row['price'];
    $sklad=$row['sklad'];
    $priceNew=$row['price_n'];
    $price=($price+(($price*$LoadItems['System']['percent'])/100));
    $pic_small=$row['pic_small'];
    $baseinputvaluta=$row['baseinputvaluta'];

    // ����� Multibase
    $admoption=unserialize($LoadItems['System']['admoption']);
    if($admoption['base_enabled'] == 1 and !empty($admoption['base_host']))
        $pic_small=eregi_replace("/UserFiles/","http://".$admoption['base_host']."/UserFiles/",$pic_small);

    // ������� �� ���� ������ ������� ����
    if(session_is_registered('UsersStatus')) {
        $GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
        if($GetUsersStatusPrice>1) {
            $pole="price".$GetUsersStatusPrice;
            $pricePersona=$row[$pole];
            if(!empty($pricePersona))
                $price=($pricePersona+(($pricePersona*$LoadItems['System']['percent'])/100));
        }
    }

    // ���� ���� ����� ����
    if($priceNew>0) {
        $priceNew=($priceNew+(($priceNew*$LoadItems['System']['percent'])/100));
        $priceNew=number_format($priceNew,"2",".","");
        //$priceNew=$priceNew." ".$System['dengi'];
    }

    // �������� �� ������� ����
    if(!is_numeric($row['price'])) $sklad = 1;
    $array=array(
            "category"=>$category,
            "id"=>$id,
            "uid"=>$uid,
            "description"=>$description,
            "price"=>$price,
            "priceNew"=>$priceNew,
            "priceSklad"=>$sklad,
            "name"=>$name,
            "baseinputvaluta"=>$baseinputvaluta,
            "pic_small"=>$pic_small
    );

    $SysValue['sql']['num']++;

    if($id>=1) return $array;
    else return false;
}


/**
 * ����� ������� ���������
 * @package PHPShopCoreDepricated
 * @param int $id �� ������
 * @return string
 */
function DispOdnotip($id) {
    global $SysValue,$LoadItems;

    $disp=null;
    $admoption=unserialize($LoadItems['System']['admoption']);

    // �������� ������ �������
    if(is_array($LoadItems['Product'][$id]['odnotip']))
        foreach($LoadItems['Product'][$id]['odnotip'] as $value) {
            $ReturnProductData=ReturnProductData($value);
            if(!empty($ReturnProductData)) $Product[$value]=ReturnProductData($value);
        }

    // �������� ������ ������������
    if(is_array($Product))
        foreach($Product as $value) {
            $Podcatalog[$value['category']]=ReturnCatalogData($value['category']);
        }


    if(is_array($Product))
        foreach($Product as $val=>$p) {

            // ���������� ���������
            $SysValue['other']['productName']= $p['name'];
            $SysValue['other']['productSale']= $SysValue['lang']['product_sale'];
            $SysValue['other']['productInfo']= $SysValue['lang']['product_info'];
            $SysValue['other']['productValutaName']= GetValuta();

            // ����� ����������� ��������, � ������������ �������
            $sql="select * from ".$SysValue['base']['table_name2']." where pic_small='".$p['pic_small']."'";
            $result=mysql_query($sql);
            $num=mysql_num_rows($result);
            while($row = mysql_fetch_array($result)) {
                $name_foto_big=$row['pic_big'];
            }
            $SysValue['other']['productImgBigFoto']= $name_foto_big;

            // ���� ����� �� ������
            if($Product[$val]['priceSklad']==0) {

                $SysValue['other']['Notice']="";
                $SysValue['other']['ComStartCart']="";
                $SysValue['other']['ComEndCart']="";
                $SysValue['other']['ComStartNotice']="<!--";
                $SysValue['other']['ComEndNotice']="-->";

                // ���� ��� ����� ����
                if(empty($Product[$val]['priceNew'])) {
                    $SysValue['other']['productPrice']=GetPriceValuta($Product[$val]['price'],"",$Product[$val]['baseinputvaluta']);
                    $SysValue['other']['productPriceRub']= "";
                }else {// ���� ���� ����� ����
                    $SysValue['other']['productPrice']=GetPriceValuta($Product[$val]['price'],"",$Product[$val]['baseinputvaluta']);
                    $SysValue['other']['productPriceRub']= "<strike>".GetPriceValuta($Product[$val]['priceNew'],"",$Product[$val]['baseinputvaluta'])." ".GetValuta()."</strike>";
                }
            }
            else { // ����� ��� �����
                $SysValue['other']['productPrice']=$SysValue['lang']['sklad_no'];
                $SysValue['other']['productPriceRub']=$SysValue['lang']['sklad_mesage'];
                $SysValue['other']['productValutaName']="";
                $SysValue['other']['ComStartNotice']="";
                $SysValue['other']['ComEndNotice']="";
                $SysValue['other']['ComStartCart']="<!--";
                $SysValue['other']['ComEndCart']="-->";
                $SysValue['other']['productNotice']=$SysValue['lang']['product_notice'];
            }

            // ��������� Pro
            if($SysValue['pro']['enabled'] == "true") {
                $SysValue['other']['productPrice']=GetPriceValuta(ReturnTruePriceUser($val['uid'],$Product[$val]['price']),"",$Product[$val]['baseinputvaluta']);
            }

            // ���� ���� ���������� ������ ����� ����������
            if($admoption['user_price_activate']==1 and empty($_SESSION['UsersId'])) {
                $SysValue['other']['ComStartCart']="<!--";
                $SysValue['other']['ComEndCart']="-->";
                $SysValue['other']['productPrice']="";
                $SysValue['other']['productValutaName']="";
            }

            // ����� ����� ��� �������
            $DispCatOptionsTest=DispCatOptionsTest($Product[$val]['category']);
            if($DispCatOptionsTest == 1) {
                $SysValue['other']['ComStartCart']="<!--";
                $SysValue['other']['ComEndCart']="-->";
            }else {
                $SysValue['other']['ComStartCart']="";
                $SysValue['other']['ComEndCart']="";
            }

            $SysValue['other']['productImg']= $Product[$val]['pic_small'];
            $SysValue['other']['productDesOdnotip']= $Product[$val]['description'];
            $SysValue['other']['productDes']= $Product[$val]['description'];
            $SysValue['other']['productUid']= $val;
            $SysValue['other']['productImgOdnotip']= $Product[$val]['pic_small'];
            $disp.=ParseTemplateReturn($SysValue['templates']['main_spec_forma_icon']);

        }
    return $disp;
}


/**
 * ����� ������� ��������
 * @package PHPShopCoreDepricated
 * @param int $id �� ������
 * @return string
 */
function DispParent($id) {
    global $SysValue,$LoadItems;

    $disp=null;

    // �������� ������ �������
    foreach($LoadItems['Product'][$id]['parent'] as $value) {
        if(true_parent($value)) $Product[$value]=ReturnProductData($value,2);
        else $Product[$value]=ReturnProductData($value);
    }

    if(is_array($Product))
        foreach($Product as $val=>$p) {
            if(!empty($p)) {

                // ���������� ����������
                //$SysValue['other']['productName']= $p['name'];
                $SysValue['other']['productSale']= $SysValue['lang']['product_sale'];
                $SysValue['other']['productInfo']= $SysValue['lang']['product_info'];
                $SysValue['other']['productValutaName']= GetValuta();

                // ���� ����� �� ������
                if($Product[$val]['priceSklad']==0) {
                    $SysValue['other']['productPrice']=GetPriceValuta($Product[$val]['price'],"",$Product[$val]['baseinputvaluta']);
                }

                $SysValue['other']['productUid']= $val;
                $disp.="<option value='".$val."' >".$p['name']." -  (".$SysValue['other']['productPrice']." ".$SysValue['other']['productValutaName'].")</option>";
            }
        }

    $dis="<select name=\"parentId\" id=\"parentId\">";

    if(!empty($LoadItems['Product'][$id]['price']))
        $dis.="<option value='".$id."' >".$LoadItems['Product'][$id]['name']." -  (".GetPriceValuta($LoadItems['Product'][$id]['price'],"",$LoadItems['Product'][$id]['baseinputvaluta'])." ".$SysValue['other']['productValutaName'].")</option>
	";

    $dis.=$disp."</select>";

    $SysValue['other']['parentList']=$dis;

    $dis=ParseTemplateReturn("product/product_odnotip_product_parent.tpl");
    return $dis;
}


/**
 * ����� ��������� ���� � ������
 * @package PHPShopCoreDepricated
 * @param int $n �� ������
 * @return string
 */
function DispPodrobno($n) {
    global $SysValue,$LoadItems,$cat,$p,$v;

    $n=TotalClean($n,1);
    $cat=TotalClean($cat,1);
    $i=0;

    $sql="select * from ".$SysValue['base']['table_name2']." where id=$n and parent_enabled='0' and enabled='1'";
    $result=mysql_query($sql);
    $SysValue['sql']['num']++;

    $row = mysql_fetch_array($result);
    $id=$row['id'];
    $uid=$row['uid'];
    $name=stripslashes($row['name']);
    $category=$row['category'];
    $content=stripslashes($row['content']);
    $odnotip=$row['odnotip'];
    $vendor_array=$row['vendor_array'];
    $price=$row['price'];
    $sklad=$row['sklad'];
    $items=$row['items'];
    $priceNew=$row['price_n'];
    $price=($price+(($price*$LoadItems['System']['percent'])/100));
    $pic_big=$row['pic_big'];
    $files=unserialize($row['files']);
    $baseinputvaluta=$row['baseinputvaluta'];

    if(empty($row['ed_izm'])) $ed_izm = "��.";
    else $ed_izm = $row['ed_izm'];

    // ������� �� ���� ������ ������� ����
    if(session_is_registered('UsersStatus')) {
        $GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
        if($GetUsersStatusPrice>1) {
            $pole="price".$GetUsersStatusPrice;
            $pricePersona=$row[$pole];
            if(!empty($pricePersona))
                $price=($pricePersona+(($pricePersona*$LoadItems['System']['percent'])/100));
        }
    }

    // ���� ���� ����� ����
    if($priceNew>0) {
        $priceNew=($priceNew+(($priceNew*$LoadItems['System']['percent'])/100));
        $priceNew=number_format($priceNew,"2",".","");
    }

    // �������� �� ������� ����
    if(!is_numeric($row['price']))
        $sklad = 1;
    $uid=$row['uid'];
    $parent=explode(",",$row['parent']);
    $vendor=$row['vendor'];

    $admoption=unserialize($LoadItems['System']['admoption']);

    //������������� �����
    if($admoption['digital_product_enabled'] != 1)
        if (is_array($files)) {
            $SysValue['other']['productFiles']='';
            foreach ($files as $cfile) {
                $SysValue['other']['productFiles'].='<img src="images/shop/action_save.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="3"><A href="'.$cfile.'" target="_blank">'.basename($cfile).'</A><BR>';
            }
        } else {
            $SysValue['other']['productFiles']=$SysValue['lang']['no_files'];
        } else $SysValue['other']['productFiles']=$SysValue['lang']['files_only_payment'];

    // �����������
    $SysValue['other']['productFotoList'] = getFotoIconPodrobno($id,$pic_big,$name);

    // ����� Multibase
    if($admoption['base_enabled'] == 1 and !empty($admoption['base_host']))
        $pic_big=eregi_replace("/UserFiles/","http://".$admoption['base_host']."/UserFiles/",$pic_big);

    // ���������� ��������� ������
    if($admoption['sklad_enabled'] == 1 and $items>0)
        $SysValue['other']['productSklad']= $SysValue['lang']['product_on_sklad']." ".$items." ".$ed_izm;
    else $SysValue['other']['productSklad']="";

    // ������ ��������
    if(empty($pic_big))
        $pic_big="images/shop/no_photo.gif";

    // ���������� ���������
    $SysValue['other']['productSale']= $SysValue['lang']['product_sale'];
    $SysValue['other']['productBack']= $SysValue['lang']['product_back'];
    $SysValue['other']['productArt']= $uid;
    $SysValue['other']['productDes']= $content;

    // ������
    $SysValue['other']['productValutaName']= GetValuta();
    $SysValue['other']['productImg']= $pic_big;

    // ������� �������������
    $SysValue['other']['vendorDisp']=DispCatSortTable($category,$vendor_array);

    // ����� ������
    $SysValue['other']['optionsDisp']=DispCatOptions($category,$id);
    $SysValue['other']['productName']= $name;

    // �������
    $SysValue['other']['ratingfull']=ratingfull($id,$category);

    // ���� ����� �� ������
    if($sklad == 0) {

        $SysValue['other']['Notice']="";
        $SysValue['other']['ComStartCart']="";
        $SysValue['other']['ComEndCart']="";
        $SysValue['other']['ComStartNotice']="<!--";
        $SysValue['other']['ComEndNotice']="-->";

        // ���� ��� ����� ����
        if(empty($priceNew)) {
            $SysValue['other']['productPrice']=GetPriceValuta($price,"",$baseinputvaluta);
            $SysValue['other']['productPriceRub']= "";
        }else {// ���� ���� ����� ����
            $SysValue['other']['productPrice']=GetPriceValuta($price,"",$baseinputvaluta);
            $SysValue['other']['productPriceRub']= "<strike>".GetPriceValuta($priceNew,"",$baseinputvaluta)." ".GetValuta()."</strike>";
        }
    }
    else { // ����� ��� �����
        $SysValue['other']['productPrice']=GetPriceValuta($price,"",$baseinputvaluta);
        $SysValue['other']['productPriceRub']=$SysValue['lang']['sklad_mesage'];
        $SysValue['other']['productValutaName']=GetValuta();
        $SysValue['other']['ComStartNotice']="";
        $SysValue['other']['ComEndNotice']="";
        $SysValue['other']['ComStartCart']="<!--";
        $SysValue['other']['ComEndCart']="-->";
        $SysValue['other']['productNotice']=$SysValue['lang']['product_notice'];
    }

    $SysValue['other']['productId']= $id;
    $SysValue['other']['productUid']= $id;
    $SysValue['other']['productCat']= $LoadItems['Catalog'][$category]['parent_to'];

    // �������
    if($row['parent']!="") {
        $SysValue['other']['ComStartCart']="<!--";
        $SysValue['other']['ComEndCart']="-->";

    }else {
        $SysValue['other']['ComStart']="";
        $SysValue['other']['ComEnd']="";
    }

    // ������ �� ����
    if($row['page']!="") {
        $SysValue['other']['temaContent']= DispProductPage($id);
        $SysValue['other']['temaTitle']= $SysValue['lang']['product_page'];
        $pagetemaDisp=ParseTemplateReturn($SysValue['templates']['product_pagetema_list']);
        $SysValue['other']['pagetemaDisp']= $pagetemaDisp;
    }

    // �������
    if($row['parent']!="") {
        $SysValue['other']['productParentList']= DispParent($id);
        $SysValue['other']['productPrice']="";
        $SysValue['other']['productPriceRub']="";
        $SysValue['other']['productValutaName']="";
    }

    // ���� ���� ���������� ������ ����� ����������
    if($admoption['user_price_activate']==1 and empty($_SESSION['UsersId'])) {
        $SysValue['other']['ComStartCart']="<!--";
        $SysValue['other']['ComEndCart']="-->";
        $SysValue['other']['productPrice']="";
        $SysValue['other']['productValutaName']="";
    }

    // ���������� ������
    $dis=ParseTemplateReturn($SysValue['templates']['main_product_forma_full']);

    // ��������
    if($row['odnotip']!="") {
        $SysValue['other']['productOdnotipList']= DispOdnotip($id);
        $SysValue['other']['productOdnotip']= $SysValue['lang']['odnotip'];
        $odnotipDisp=ParseTemplateReturn($SysValue['templates']['main_product_odnotip_list']);
        $SysValue['other']['odnotipDisp']= $odnotipDisp;
    }

    // ���������� ����������
    $SysValue['other']['catalog']= $SysValue['lang']['catalog'];
    $SysValue['other']['odnotipDisp']= $odnotipDisp;
    $SysValue['other']['pagetemaDisp']=$pagetemaDisp;
    $cat=$LoadItems['Catalog'][$category]['parent_to'];
    $SysValue['other']['catalogCat']= $LoadItems['Catalog'][$cat]['name'];
    $SysValue['other']['catalogId']= $LoadItems['Catalog'][$cat]['id'];
    $SysValue['other']['catalogUId']= $cat;
    $SysValue['other']['pcatalogId']= $LoadItems['Catalog'][$category]['id'];
    $SysValue['other']['catalogCategory']=$LoadItems['Catalog'][$category]['name'];
    $SysValue['other']['productPageDis']=$dis;
    $SysValue['other']['productPageNum']=$p;
    $SysValue['other']['productPageVendor']='0'.$vendor;
    $SysValue['other']['productPodcat']=$category;
    $SysValue['other']['productName']= $name;

    if(isset($name)) $disp=ParseTemplateReturn($SysValue['templates']['product_page_full']);
    else $disp=404;

    return $disp;
}

/**
 * �������� multibase
 * @package PHPShopDepricated
 * @return string
 */
function ReturnServerSort() {
    global $SysValue,$LoadItems;
    $sort=null;

    foreach($LoadItems['Podcatalog'] as $k=>$v) {
        if(!empty($v['servers'])) {
            $sort.=" or category=".$k;
        }
    }
    return " and (category=0 ".$sort.")";
}


/**
 * ����� ��������������� �� ������� �������
 * @package PHPShopElementsDepricated
 * @return string
 */
function DispSpecMain() {
    global $SysValue,$LoadItems;

    $admoption=unserialize($LoadItems['System']['admoption']);
    if($admoption['base_enabled'] == 1 and !empty($admoption['base_host']))
        $sort=ReturnServerSort();

    $Disp = new DispSpec();
    $Disp->sql="select * from ".$SysValue['base']['table_name2']." where spec='1' and  enabled='1' ".@$sort." order by  RAND() LIMIT 0, ".$LoadItems['System']['spec_num'];
    $Disp->setka_num=$LoadItems['System']['num_vitrina'];
    $Disp->setka_style="setka";
    $Disp->template=$SysValue['templates']['main_product_forma_'.$Disp->setka_num];

    $Disp->Engen();
    $Return=$Disp->disp;
    return $Return;
}

/**
 * ����� �������  ������ ������� ��������������� � �������
 * @package PHPShopElementsDepricated
 * @param string $string �������������� ������� �������
 * @return string
 */
function DispNewIcon($string="") {
    global $SysValue,$LoadItems;
    $sort=null;

    $admoption=unserialize($LoadItems['System']['admoption']);
    if($admoption['base_enabled'] == 1 and !empty($admoption['base_host']))
        $sort=ReturnServerSort();

    $Disp = new DispSpec();
    $string=TotalClean($string,2);
    $Disp->sql="select * from ".$SysValue['base']['table_name2']." where enabled='1' and parent_enabled='0'  $string ".$sort." order by id desc LIMIT 0, ".$LoadItems['System']['new_num'];

    $Disp->setka_num=1;
    $Disp->setka_style="";
    $Disp->template=$SysValue['templates']['main_spec_forma_icon'];

    $Disp->Engen();
    $Return=$Disp->disp;

    return $Return;
}


/**
 * ����� ������� �� ������� �������
 * @package PHPShopElementsDepricated
 * @param int $num ���-�� ������� � ����� ������
 * @param int $spec_num ����� �������
 * @param string $template_name ��� ������� ������
 * @return string
 */
function DispNewMain($num=false,$spec_num=false,$template_name=false) {
    global $SysValue,$LoadItems;
    $sort=null;

    $admoption=unserialize($LoadItems['System']['admoption']);
    if($admoption['base_enabled'] == 1 and !empty($admoption['base_host']))
        $sort=ReturnServerSort();

    $Disp = new DispSpec();
    if(!$spec_num) {
        $Disp->sql="select * from ".$SysValue['base']['table_name2']." where newtip='1' and  enabled='1' ".$sort." order by  RAND() LIMIT 0, ".$LoadItems['System']['spec_num'];
    }else {
        $Disp->sql="select * from ".$SysValue['base']['table_name2']." where newtip='1' and  enabled='1' ".$sort." order by  RAND() LIMIT 0, ".$spec_num;
    }

    if(!$num) $Disp->setka_num=$LoadItems['System']['num_vitrina'];
    else $Disp->setka_num=$num;


    $Disp->setka_style="setka";
    if(!$template_name) $Disp->template=$SysValue['templates']['main_product_forma_'.$Disp->setka_num];
    else $Disp->template=$SysValue['templates'][$template_name];

    $Disp->Engen();
    $Return=$Disp->disp;

    return $Return;
}

/**
 * �������������� ������ � �������� ��� SEO
 * @package PHPShopDepricated
 * @param string $str string
 * @return string
 */
function NameToLatin($str) {
    $str=strtolower($str);
    $str=str_replace("/", "", $str);
    $str=str_replace("\\", "", $str);
    $str=str_replace("(", "", $str);
    $str=str_replace(")", "", $str);
    $str=str_replace(":", "", $str);
    $str=str_replace("-", "", $str);
    $str=str_replace(" ", "", $str);

    $_Array=array(
            "�"=>"a",
            "�"=>"b",
            "�"=>"v",
            "�"=>"g",
            "�"=>"d",
            "�"=>"e",
            "�"=>"e",
            "�"=>"gh",
            "�"=>"z",
            "�"=>"i",
            "�"=>"i",
            "�"=>"k",
            "�"=>"l",
            "�"=>"m",
            "�"=>"n",
            "�"=>"o",
            "�"=>"p",
            "�"=>"r",
            "�"=>"s",
            "�"=>"t",
            "�"=>"u",
            "�"=>"f",
            "�"=>"h",
            "�"=>"c",
            "�"=>"ch",
            "�"=>"sh",
            "�"=>"sh",
            "�"=>"i",
            "�"=>"yi",
            "�"=>"i",
            "�"=>"a",
            "�"=>"u",
            "�"=>"ya",
            "�"=>"a",
            "�"=>"b",
            "�"=>"v",
            "�"=>"g",
            "�"=>"d",
            "�"=>"e",
            "�"=>"gh",
            "�"=>"z",
            "�"=>"i",
            "�"=>"i",
            "�"=>"k",
            "�"=>"l",
            "�"=>"m",
            "�"=>"n",
            "�"=>"o",
            "�"=>"�",
            "�"=>"r",
            "�"=>"s",
            "�"=>"t",
            "�"=>"u",
            "�"=>"f",
            "�"=>"h",
            "�"=>"c",
            "�"=>"ch",
            "�"=>"sh",
            "�"=>"sh",
            "�"=>"a",
            "�"=>"u",
            "�"=>"ya",
            "."=>"_",
            "$"=>"i",
            "%"=>"i",
            "&"=>"and"
    );

    $chars = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    $new_str=null;
    foreach($chars as $val)
        if(empty($_Array[$val])) $new_str.=$val;

    return $new_str;
}
?>