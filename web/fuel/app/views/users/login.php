<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php echo isset($message) ? html_entity_decode($message) : '';?>
			<?php echo Form::open(array('method' => 'post', 'role' => 'form', 'style' => 'margin-top: 100px;'));?>
			<?php echo Form::csrf();?>
				<div class="form-group">
					<label for="exampleInputEmail1">Username</label> <input
						type="text" class="form-control" id="exampleInputEmail1"
						placeholder="Enter username" name="username">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label> <input
						type="password" class="form-control" id="exampleInputPassword1"
						placeholder="Enter password" name="password">
				</div>
				<button type="submit" class="btn btn-default">Login</button>
			<?php echo Form::close();?>
		</div>
	</div>
</div>
