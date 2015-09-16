<div class="container">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<?php echo Form::open(array('role' => 'form', 'method' => 'post'))?>
						<?php echo Form::csrf();?>
							<?php if(isset($message)) echo html_entity_decode($message);?>
							<div class="form-group">
								<label for="current-password">Current</label>
								<input type="password" class="form-control" id="current-password" placeholder="Enter your current password" name="old_password">
							</div>
							<div class="form-group">
								<label for="new-password">New</label>
								<input type="password" class="form-control" id="new-password" placeholder="Enter your new password" name="new_password">
							</div>
							<div class="form-group">
								<label for="retype-password">Retype</label>
								<input type="password" class="form-control" id="retype-password" placeholder="Retype your new password" name="retype_password">
							</div>
							<div class="form-group pull-right">
								<button type="submit" class="btn btn-default">Save</button>
								<a href="#"><button type="button" type="reset" class="btn btn-primary">Cancel</button></a>
							</div>
						<?php echo Form::close();?>
					</div>
				</div>
			</div>