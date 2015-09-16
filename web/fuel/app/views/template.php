<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo $title;?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::js('jquery.js'); ?>
</head>
<body>
	<div class="container-fluid" style="background-color: #28AAE0;border-color: #28AAE0;">
		<div class="container">
				<div class="navbar-header col-md-3">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="glyphicon glyphicon-align-justify" style="color:#fff"></span>
					</button>
					<a class="logo" href="<?php echo Uri::base()?>">Mini Blog</a>
				</div>
				<div class="col-md-5" style="margin-top: 8px;">
					<?php echo Form::open(array('role' => 'form', 'action' => Uri::base().'searchUser.html', 'method' => 'post'))?>
					<?php echo Form::csrf();?>
					<div class="input-group">
						<input name="keyword" class="form-control txtSearch"  placeholder="Firstname, Lastname, Username" type="text">
						<span class="input-group-btn">
							<input class="btn btn-primary" value="Search" type="submit">
						</span>

					</div><!-- /input-group -->

					<?php echo Form::close();?>
				</div>
				<div id="navbar" class="navbar-collapse collapse col-md-4">
					<ul class="nav navbar-nav navbar-right">
						<li <?php echo Uri::segment(1) == 'list-all-posts' ? 'class="active"':''?>><a href="<?php echo Uri::base()?>list-all-posts.html">Blog</a></li>
					<?php
						if(Session::get('token')) :
					?>
						<li class="dropdown <?php if (Uri::segment(1) == 'UpdateUserInfo' or
						 Uri::segment(1) == 'change-password' or Uri::segment(1) == 'manage-post') echo 'active'?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">My Account<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li <?php echo Uri::segment(1) == 'UpdateUserInfo' ? 'class="active"':''?>><a href="<?php echo Uri::base()?>UpdateUserInfo.html">Update Info</a></li>
								<li <?php echo Uri::segment(1) == 'change-password' ? 'class="active"':''?>><a href="<?php echo Uri::base()?>change-password.html">Change Password</a></li>
								<li <?php echo Uri::segment(1) == 'manage-post' ? 'class="active"':''?>><a href="<?php echo Uri::base()?>/manage-post.html">Manage Post</a></li>
								<li><a href="<?php echo Uri::base()?>logout.html">Log out</a></li>
							</ul>
						</li>
					<?php else :?>
						<li><a href="login.html">Login</a></li>
					<?php endif;?>
					</ul>
				</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="container">
		<div class="row" style="margin-top:10px;">
			<ol class="breadcrumb">
				<?php foreach ($breadcrumbs as $k => $v):?>
				<li <?php echo $v == '' ? 'class="active"' : ''?>><a <?php echo $v != '' ? 'href="'.$v.'"' : '' ;?>><?php echo $k;?></a></li>
				<?php endforeach;?>
			</ol>
			<!--Content-->
			<?php echo $content;?>
			<!--End Content-->
		</div>
	<?php echo Asset::js('bootstrap.js'); ?>
	</div>
</body>
</html>