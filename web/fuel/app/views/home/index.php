<div class="container-fluid">
	<div class="row">
	<?php
	$i = 1;
	foreach ($data->posts as $v):?>
		<div class="col-md-2">
			<a href="#"> <img data-holder-rendered="true"
				src="<?php echo $v->image?>" style="" class="img-responsive" alt="">
			</a>
		</div>
		<div class="col-md-4">
			<div class="title">
				<a href="<?php echo Uri::base().'detail/'.$v->id?>"><?php echo $v->title?>
				</a>
			</div>
			<div class="date">
			<?php echo date('d/m/Y H:i', strtotime($v->created_at))?>
				| Author: <a href="<?php echo Uri::base()?>list-user-posts/<?php echo $v->user->id?>"><?php echo $v->user->firstname, ' ', $v->user->lastname;?>
				</a>
			</div>
			<div class="description">
			<?php echo $v->description?>
			</div>
		</div>
		<?php
		if ($i%2 == 0) {
			echo '</div><br><div class="row">';
		}
		$i++;
		?>
		<?php endforeach;?>
	</div>
	<br>

</div>
