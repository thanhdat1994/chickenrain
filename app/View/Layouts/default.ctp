<!DOCTYPE html>

<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width" />
    <title>
    	<?php echo $this->fetch('title'); ?>
    </title>
    <?php echo $this->Html->meta('icon'); ?>

    <?php echo $this->Html->css('bootstrap.min'); ?>
    <?php echo $this->Html->css('font-awesome.min'); ?>
    <?php echo $this->Html->css('animate'); ?>
    <?php echo $this->Html->css('main'); ?>
    <?php echo $this->Html->css('prettyPhoto'); ?>
    <?php echo $this->Html->css('price-range'); ?>
    <?php echo $this->Html->css('responsive'); ?>	
	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

</head>
<body>
	<header id="header">
		<!--header-->
		<div class="header-middle">
			<!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="/img/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="tai-khoan"><i class="fa fa-user"></i> Tài khoản</a></li>
								<li><a href="thanh-toan.html"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<li><a href="gio-hang.html"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<li><a href="dang-nhap.html"><i class="fa fa-lock"></i> Đăng nhập</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom">
			<!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li>
									<?php echo $this->Html->link('Trang chủ',''); ?>
								</li>
								<li>
									<?php echo $this->Html->link('Sách mới','/sach-moi'); ?>
								</li>
								<li>
									<a href="#">Sách bán chạy</a>
								</li>
								<li>
									<a href="#">Sách khuyến mãi</a>
								</li>
								<li>
									<a href="#">Liên hệ</a>
								</li>								
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<?php echo $this->Form->create('Book',['url'=>['action'=>'get_keyword']]); ?>
						<?php echo $this->Form->Input('keyword',['label'=>'','placeholder'=>'Tìm kiếm....','class'=>'search_box pull-right']); ?>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="slider">
		<!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								</div>
								<div class="col-sm-6">
									<img src="/img/home/girl1.jpg" class="girl img-responsive" alt="" />
									<img src="/img/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								</div>
								<div class="col-sm-6">
									<img src="/img/home/girl2.jpg" class="girl img-responsive" alt="" />
									<img src="/img/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>

							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								</div>
								<div class="col-sm-6">
									<img src="/img/home/girl3.jpg" class="girl img-responsive" alt="" />
									<img src="/img/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>
						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<!-- sidebar -->
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sách</h2>
						<div class="panel-group category-products" id="accordian">
							<!--category-productsr-->
							<?php echo $this->element('menu_categories'); ?>
						</div><!--/category-products-->
						<h2>Tác giả</h2>
						<div class="panel-group category-products" id="accordian">
							<!--category-writers-->
							<?php echo $this->element('menu_writers'); ?>
						</div><!--/category-writers-->
					</div>
				</div> <!-- end sidebar -->

				<div class="col-sm-9 padding-right">
									
				<?php echo $this->Flash->render(); ?>

				<?php echo $this->fetch('content'); ?>					

				</div>
			</div>
		</div>
	</section>

	<footer id="footer">
		<!--Footer-->
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Nhận thông báo của shop</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Nhập email của bạn tại đây" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2017 Nhóm ... Inc.</p>					
				</div>
			</div>
		</div>

	</footer><!--/Footer-->


	<?php echo $this->Html->script('jquery'); ?>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->Html->script('jquery.scrollUp.min'); ?>
	<?php echo $this->Html->script('price-range'); ?>
	<?php echo $this->Html->script('jquery.prettyPhoto'); ?>
	<?php echo $this->Html->script('main'); ?>
</body>
</html>
