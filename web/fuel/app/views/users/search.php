<?php if (isset($data)) :?>
<style type="text/css">
		.red{ color: red;}
	</style>
<div class="container-fluid">
	<div class="col-md-12" style="margin-bottom: 10px;">
		<?php echo isset($message) ? html_entity_decode($message) : '';?>
	</div>

	<div class="row">
		<?php
			$i =1;
			foreach ($data->item as $v) :
		?>
		<div class="col-md-4">
			<div class="col-md-5">
				<a href="#"> <img data-holder-rendered="true"
					src="<?php echo $v->avatar?>"
					style="" class="img-responsive" alt=""> </a>
			</div>
			<div class="col-md-7">
				<div class="title"><?php echo $v->username?></div>
				<div class="date">Date join: <?php echo date('d/m/Y', strtotime($v->created_at))?></div>
				<div>Firstname: <?php echo $v->firstname?></div>
				<div>Lastname: <?php echo $v->lastname?></div>
				<div class="title">
					<a href="<?php echo Uri::base()?>list-user-posts/<?php echo $v->id?>">View all Post</a>
				</div>
			</div>

		</div>
		<?php
			if ($i % 3 == 0) {
				echo '</div><br><div class="row">';
			}
			$i++;
		?>
		<?php endforeach;?>
	</div>
	<br>


	<nav>
		<?php echo html_entity_decode($pagination);?>
	</nav>
</div>
<?php endif;?>
