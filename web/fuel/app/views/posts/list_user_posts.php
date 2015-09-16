<?php if(isset($data)) : ?>
<div class="row">
	<form action="" role="form">
		<div class="col-md-8">
			<div class="col-md-1" style="padding-top: 6px;">
				<label for="Sort" class="control-label">Sort</label>
			</div>
			<div class="col-md-3">
				<select name="order" class="form-control order" onchange="change_value()">
					<option value="newest" <?php if(isset($_GET['order']) and $_GET['order'] == 'newest') echo 'selected="true"'?>>Newest</option>
					<option value="most_comment" <?php if(isset($_GET['order']) and $_GET['order'] == 'most_comment') echo 'selected="true"'?>>Most comment</option>
					<option value="name" <?php if(isset($_GET['order']) and $_GET['order'] == 'name') echo 'selected="true"'?>>Name (A-Z)</option>
				</select>
			</div>
			<div class="col-md-1" style="padding-top: 6px;">
				<label for="Show" class="control-label">Show</label>
			</div>
			<div class="col-md-2">
				<select name="limit" class="form-control limit" onchange="change_value()">
					<option value="10" <?php if(isset($_GET['limit']) and $_GET['limit'] == '10') echo 'selected="true"'?>>10</option>
					<option value="20" <?php if(isset($_GET['limit']) and $_GET['limit'] == '20') echo 'selected="true"'?>>20</option>
					<option value="30" <?php if(isset($_GET['limit']) and $_GET['limit'] == '30') echo 'selected="true"'?>>30</option>
				</select>
			</div>
		</div>
	</form>
</div><br>
<div class="container">
	<div class="row">
		<?php $i = 1; foreach ($data->posts as $v):?>
		<div class="col-md-2">
			<a href="#">
				<img data-holder-rendered="true" src="<?php echo $v->image?>" style="" class="img-responsive" alt="">
			</a>
		</div>
		<div class="col-md-4">
			<div class="title"><a href="<?php echo Uri::base().'detail/'.$v->id?>"><?php echo $v->title?></a></div>
			<div class="date"> <?php echo date('d/m/Y H:i', strtotime($v->created_at))?></div>
			<div class="description">
				<?php echo $v->description?>
			</div>
		</div>
		<?php
			if ($i % 2 == 0) echo '</div><br><div class="row">';
			$i++;
		?>
		<?php endforeach;?>
	</div><br>

</div>
<div class="col-md-12">
	<?php echo html_entity_decode($pagination);?>
</div>
<script type="text/javascript">
	function change_value(){
		$limit = $('.limit').val();
		$order = $('.order').val();
		window.location.href = "<?php echo Uri::base()?>list-all-posts/<?php echo Uri::segment(2)?>?limit="+$limit+"&order="+$order;
	}
</script>
<?php endif;?>