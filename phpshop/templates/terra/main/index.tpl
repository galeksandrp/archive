<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="windows-1251">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@pageTitl@</title>
<meta name="description" content="@pageDesc@">
<meta name="keywords" content="@pageKeyw@">
<meta name="copyright" content="@pageReg@">
<meta content="General" name="rating">
<meta name="ROBOTS" content="ALL">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="icon" href="/favicon.ico"> 

<!-- Bootstrap -->
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap.min.css" rel="stylesheet">

<!-- Theme -->
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@terra_theme@.css" rel="stylesheet">

<!-- jQuery -->
<script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-1.11.0.min.js"></script>

<!-- jQuery Plugins -->
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery.bxslider.css" rel="stylesheet">
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery-ui.min.css" rel="stylesheet">
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap-select.min.css" rel="stylesheet">
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bar.css" rel="stylesheet">
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/swiper.min.css" rel="stylesheet">
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/suggestions.min.css" rel="stylesheet">
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/slick.css" rel="stylesheet"/>
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/slick-theme.css" rel="stylesheet"/>

<!-- Template -->
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/animate.css" rel="stylesheet">
<link href="@pageCss@" rel="stylesheet">
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/responsive.css" rel="stylesheet">

<!-- Fonts -->
<link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=cyrillic" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body id="body" data-dir="@ShopDir@" data-path="@php echo $GLOBALS['PHPShopNav']->objNav['path']; php@" data-id="@php echo $GLOBALS['PHPShopNav']->objNav['id']; php@" data-token="@dadataToken@">
<div id="bootstrap_theme" data-name="@php echo $_SESSION['skin']; php@"></div>

	<header>

		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="header-links">
							<ul class="top-nav visible-lg visible-md">
                                                                <li class="active"><a href="/">@name@</a></li>
                                                                @topMenu@
								<li><a href="/news/">�������</a></li>
							</ul>
							<ul class="top-nav-right">
								<li><a href="/compare/"><i class="fa fa-sliders" aria-hidden="true"></i> ��������</a></li>
								@wishlist@
							</ul>
						</div>
					</div>
				</div><!-- /row -->
			</div>
		</div><!-- /header-top -->

 		<div class="header-middle" id="header-area">
			<div class="container">
				<div class="row">

					<div class="col-md-3 col-sm-12">
						<a id="logo" href="/" title="@name@"><img src="@logo@" alt="@name@" class="img-responsive" /></a>
					</div>

					<div class="col-md-6 col-sm-12">
						<div class="header-contacts">
							<a class="header-tel" href="tel:8@telNumMobile@">+7@telNumMobile@</a>
							@returncall@
						</div>
					</div>

					<div class="col-md-3 col-sm-12 header-middle-right">
						<div id="cart">
							<a id="cartlink" class="dropdown-toggle" href="/order/">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								<span id="cart-total">
									<span class="count" id="num">@num@</span>
								</span>
							</a>
							@visualcart@
						</div>
						<div class="header-account">
							@usersDisp@
						</div>
						<div class="search-open-button">
							<i class="fa fa-search"></i>
						</div>
					</div>

				</div><!-- /row -->
			</div>
		</div><!-- /header-middle -->



		<nav id="main-menu" class="navbar">
			<div class="container">
				<div class="row">

					<div class="col-xs-12">
						<div class="navbar-header visible-xs">
							<button type="button" class="btn btn-navbar navbar-toggle main-menu-button" data-toggle="collapse" data-target=".navbar-cat-collapse"><span class="sr-only">����</span><i class="fa fa-bars"></i></button>
						</div>

						<div class="collapse navbar-collapse navbar-cat-collapse">
							<ul class="nav navbar-nav main-navbar-top">
								<li class="main-navbar-top-catalog">
									<a href="#" id="nav-catalog-dropdown-link" class="nav-catalog-dropdown-link"><i class="fa fa-bars"></i> �������</a>
									<ul class="main-navbar-list-catalog-wrapper fadeIn animated">
										@leftCatal@
									</ul>
								</li>
								@leftCatal@
							</ul>
						</div>
					</div>

				</div><!-- /row -->
			</div>
		</nav>

        </header>



	<div class="container">
		<div class="row">
			<div class="col-xs-12">

				<div class="slider">
					@imageSlider@
				</div>
 
				<ul class="brand-list">@brandsList@</ul>
			</div>
		</div>
	</div>
	<div class="main-container main-page container">
		<div class="row">
			<div class="col-xs-12">
				<!-- Featured Products Starts -->
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#newprod">�������</a></li>
					<li><a data-toggle="tab" href="#specprod">���������������</a></li>
				</ul>
				 
				<div class="tab-content">
					<div id="newprod" class="tab-pane fade in active">
						<div class="products-list newitems-list">
							@specMainIcon@
						</div>
					</div>
					<div id="specprod" class="tab-pane fade">
						<div class="products-list spec-list">
							@specMain@
						</div>
					</div>
				</div>
				<!-- Featured Products Ends -->
    
				<!-- Popular Products Starts -->
                                <h2 class="product-head">���������� ������</h2>
                                <div class="products-list nowbuy-list">
                                    @nowBuy@
                                </div>
				<!-- Popular Products Ends -->

				<h2 class="product-head">@mainContentTitle@</h2>
				<div>@mainContent@</div>

				<div class="top-col-banners">@banersDisp@</div>
			</div>
		</div><!-- /row -->
	</div>
	<!-- Main Container Ends -->



	<!-- Footer Section Starts -->
	<footer id="footer-area">
		<div class="footer-links">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<a id="logo-footer" href="/" title="@name@"><img src="@logo@" alt="@name@" class="img-responsive" /></a>
						<div class="footer-social">
							<a class="social-button" href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
							<a class="social-button" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
							<a class="social-button" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
						</div>
					</div>


					<div class="col-md-3 col-sm-6 col-xs-12">
						<h5>����</h5>
						<ul>
							@topMenu@
							<li><a href="/page/politika_konfidencialnosti.html">�������� ������������������</a></li>
						</ul>
					</div>

			
					<div class="col-md-3 col-sm-6 col-xs-12">
						<h5>��� �������</h5>
						<ul>
							<li><a href="/users/">@UsersLogin@</a></li>
							<li><a href="/users/order.html">��������� �����</a></li>
							<li><a href="/users/notice.html">����������� � �������</a></li>
							<li><a href="/users/message.html">����� � �����������</a></li>
							<li><a href="/users/wishlist.html">���������� ������</a></li>
							@php if($_SESSION['UsersId']) echo '<li><a href="?logout=true">�����</a></li>'; php@
						</ul>
					</div>


					<div class="col-md-3 col-sm-6 col-xs-12">
						<h5>���������</h5>
						<ul>
							<li><a href="/price/" title="�����-����">�����-����</a></li>
							<li><a href="/news/" title="�������">�������</a></li>
							<li><a href="/gbook/" title="������">������</a></li>
							<li><a href="/map/" title="����� �����">����� �����</a></li>
							<li><a href="/forma/" title="����� �����">����� �����</a></li>
						</ul>
					</div>

				</div><!-- /row -->
			</div>
		</div>
	</footer>
	<!-- Footer Section Ends -->

        @editor@

        <!-- Fixed mobile bar -->
        <div class="bar-padding-fix visible-xs"> </div>
        <nav class="navbar navbar-default navbar-fixed-bottom bar bar-tab visible-xs visible-sm">
            <a class="tab-item active" href="/">
                <span class="icon icon-home"></span>
                <span class="tab-label">�����</span>
            </a>
            <a class="tab-item @user_active@" @user_link@ data-target="#userModal">
                <span class="icon icon-person"></span>
                <span class="tab-label">�������</span>
            </a>
            <a class="tab-item @cart_active@" href="/order/" id="bar-cart">
                <span class="icon icon-download"></span> <span class="badge badge-positive" id="mobilnum">@cart_active_num@</span>
                <span class="tab-label">�������</span>
            </a>
            <a class="tab-item" href="#" data-toggle="modal" data-target="#searchModal">
                <span class="icon icon-search"></span>
                <span class="tab-label">�����</span>
            </a>
        </nav>
        <!--/ Fixed mobile bar -->
        <!-- Notification -->
        <div id="notification" class="success-notification" style="display: none;">
            <div  class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                <span class="notification-alert"> </span>
            </div>
        </div>
        <!--/ Notification -->

        <!-- ��������� ���� �����������-->
        <div class="modal fade bs-example-modal-sm" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">�����������</h4>
                        <span id="usersError" class="hide">@usersError@</span>
                    </div>
                    <form method="post" name="user_forma">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="login" class="form-control" placeholder="Email..." required="">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                            </div>

                            <div class="form-group">
                                <label>������</label>
                                <input type="password" name="password" class="form-control" placeholder="������..." required="">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="safe_users" @UserChecked@> ���������
                                </label>
                            </div>

                            @facebookAuth@ @twitterAuth@
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-left">�����</button>
                            <span class="pull-right"><a href="/users/sendpassword.html" class="btn btn-default">������?</a>
                            </span>
                            <input type="hidden" value="1" name="user_enter">
                        </div>
                    </form>   
                </div>
            </div>
        </div>
        <!--/ ��������� ���� �����������-->

        <!-- ��������� ���� ���������� ������ -->
        <div class="modal fade bs-example-modal-sm" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">�����</h4>
                    </div>
                    <div class="modal-body">
                        <form  action="/search/" role="search" method="post">
                            <div class="input-group">
                                <input name="words" maxlength="50" class="form-control" placeholder="������.." required="" type="search">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--/ ��������� ���� ���������� ������ -->
		<div class="search-big-block">
			<form id="search_form_small" action="/search/" role="search" method="post" class="header-search-form">
				<input class="form-control input-lg" name="words" maxlength="50"  placeholder="{�����}..." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
				<button class="header-search-button" type="submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</form>
			<i class="search-close fa fa-times" aria-hidden="true"></i>
		</div>


        <!-- JQuery Plugins  -->
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.matchHeight.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/swiper.js"></script>
	<script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/slick.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/terra.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap-select.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/phpshop.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-ui.min.js"></script>
        <script src="java/jqfunc.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/jquery.cookie.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.maskedinput.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.suggestions.min.js"></script>
        @visualcart_lib@

        
  