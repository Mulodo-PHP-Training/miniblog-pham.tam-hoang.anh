<div class="container-fluid" style="padding-top: 15px; padding-bottom: 20px">

	<?php echo isset($message) ? html_entity_decode($message) : ''?>
	<?php if (isset($user)) : ?>
	<?php echo Form::open(array('method' => 'post', 'role' => 'form', 'class' => 'form-horizontal'));?>
			<?php echo Form::csrf();?>
		<div class="row">
			<div class="col-md-12">
				<span class="btn btn-primary blue-tab no-blue-border-top">Basic info</span>
			</div>
		</div>


		<div class="container-fluid blue-border">
			<div class="col-md-6 col-md-offset-1" style="margin-top: 10px">
				<div class="form-group">
					<label for="first-name" class="col-md-3 control-label">First name</label>
					<div class="col-md-9">
						<input value="<?php echo $user->firstname?>" name="firstname" type="text" class="form-control" id="first-name">
					</div>
				</div>
				<div class="form-group">
					<label for="last-name" class="col-md-3 control-label">Last name</label>
					<div class="col-md-9">
						<input value="<?php echo $user->lastname?>" type="text" class="form-control" id="last-name" name="lastname">
					</div>
				</div>
				<div class="form-group">
					<label for="gender" class="col-md-3 control-label">Gender</label>
					<div class="col-md-9">
						<select class="styled-select" name="gender" id="gender">
							<option value="0" <?php echo $user->gender == 0 ? 'selected="selected"' : ''?>>Female</option>
							<option value="1" <?php echo $user->gender == 1 ? 'selected="selected"' : ''?>>Male</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="birthday" class="col-md-3 control-label">Birthday</label>
					<div class="col-md-9" style="display: inline-flex">
						<select class="styled-select" name="day">
							<option value="0">Day</option>
							<?php $day = date('d', strtotime($user->birthday));?>
							<?php for($i = 1; $i< 32; $i++):?>
							<option value="<?php echo $i?>" <?php echo $i == $day ? 'selected="selected"' : ''?>><?php echo $i?></option>
							<?php endfor;?>
						</select>
						<select class="styled-select" name="month" >
							<option value="0">Month</option>
							<?php $month = date('m', strtotime($user->birthday));?>
							<?php for($i = 1; $i< 13; $i++):?>
							<option value="<?php echo $i?>" <?php echo $i == $month ? 'selected="selected"' : ''?>><?php echo $i?></option>
							<?php endfor;?>
						</select>
						<select class="styled-select" name="year">
							<option value="0">Year</option>
							<?php
								$current_year = date('Y',time());
								$year = date('Y', strtotime($user->birthday));
							?>
							<?php for($i = 1970; $i<= $current_year; $i++):?>
							<option value="<?php echo $i?>" <?php echo $i == $year ? 'selected="selected"' : ''?>><?php echo $i?></option>
							<?php endfor;?>
						</select>
					</div>
				</div>
			</div>

			<div class="col-md-3" style="margin-top: 10px">
				<div class="fileUpload btn btn-primary">
					<span>Change Avatar</span> <input
						onchange="handlerInputFileChange(this)" class="upload" type="file">
						<input type="hidden" name="avatar" class="avatar">
				</div>
				<img id="image-upload" class="img-thumbnail"
					style="width: 150px; height: 150px;" src="<?php echo $user->avatar?>"
					alt="Avatar User" />
			</div>
		</div>

		<div class="row" style="margin-top: 20px;">
			<div class="col-md-12">
				<span class="btn btn-primary blue-tab no-blue-border-top">Contact info</span>
			</div>
		</div>


		<div class="container-fluid blue-border">
			<div class="col-md-6 col-md-offset-1" style="margin-top: 10px">
				<div class="form-group">
					<label for="address" class="col-md-3 control-label">Addreess</label>
					<div class="col-md-9">
						<input value="<?php echo $user->address?>" type="text" class="form-control" id="address" name="address">
					</div>
				</div>

				<div class="form-group">
					<label for="city" class="col-md-3 control-label">City</label>
					<div class="col-md-9"><input value="<?php echo $user->city?>" type="text" class="form-control" id="city" name="city">
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="col-md-3 control-label">Email</label>
					<div class="col-md-9">
						<input value="<?php echo $user->email?>" type="email" class="form-control" id="email" name="email">
					</div>
				</div>

				<div class="form-group">
					<label for="mobile" class="col-md-3 control-label">Mobile</label>
					<div class="col-md-9">
						<input value="<?php echo Num::smart_format_phone($user->mobile)?>" type="text" class="form-control" id="mobile" name="mobile">
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 20px">
			<div class="col-md-12">
				<span class="btn btn-primary blue-tab no-blue-border-top">Comfirm</span>
			</div>
		</div>
		<div class="container-fluid blue-border">
			<div class="col-md-12"
				style="margin-top: 10px; margin-bottom: 10px; margin-left: auto; margin-right: auto; text-align: center">
				<button type="submit" class="btn btn-primary"
					style="border-radius: 0px;">OK</button>
				<button type="reset" class="btn btn-primary" style="border-radius: 0px;">CANCEL</button>
			</div>
		</div>
	<?php echo Form::close();?>
	<?php endif;?>
</div>


</div>
<script>
	$('#mobile').keypress(function(evt) {
		var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode( key );
		var regex = /[0-9]|\./;
		if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault)
				theEvent.preventDefault();
		}
		if($(this).val().length-2 <= 11){
			$(this).val(function(i, text) {
				text = text.replace(/(\d\d\d\d)(\d\d\d\d)([0-9])/, "$1.$2.$3");
				return text;
			});
		}else{
			theEvent.returnValue = false;
			if(theEvent.preventDefault)
				theEvent.preventDefault();
		}
	});

	function handlerInputFileChange(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#image-upload')
				.attr('src', e.target.result);
				$('.avatar').attr('value', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
