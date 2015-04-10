<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo $title;?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
</head>
<body>

	<div class="container-fluid" style="background-color: #28AAE0;border-color: #28AAE0;">
		<div class="container">
				<div class="navbar-header col-md-3">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="glyphicon glyphicon-align-justify" style="color:#fff"></span>
					</button>
					<a class="logo" href="index.html">Mini Blog</a>
				</div>
				<div class="col-md-5" style="margin-top: 8px;">
					<form role="form" action="searchUser.html">

					<div class="input-group">
						<input name="word" class="form-control txtSearch"  placeholder="Firstname, Lastname, Username" type="text">
						<span class="input-group-btn">
							<input class="btn btn-primary" value="Search" type="submit">
						</span>

					</div><!-- /input-group -->

					</form>
				</div>
				<div id="navbar" class="navbar-collapse collapse col-md-4">

					<ul class="nav navbar-nav navbar-right">
						<li><a href="list-all-posts.html">Blog</a></li>
						<li><a href="login.html">Login</a></li>
					</ul>
				</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="container">
		<div class="row" style="margin-top:10px;">
			<ol class="breadcrumb">
				<li><a href="index.html">Home</a></li>
			</ol>
			<!--Content-->
			<?php echo $content;?>
			<!--End Content-->
		</div>
	<?php echo Asset::js('jquery.js'); ?>
	<?php echo Asset::js('bootstrap.js'); ?>
	</div>
</body>
</html>