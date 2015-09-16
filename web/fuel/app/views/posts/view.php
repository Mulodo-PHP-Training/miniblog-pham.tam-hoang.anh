<?php if($data->post):?>
<div class="container">
				<!--About blog-->

				<div class="row">

					<div class="col-md-12">
						<h2 style="margin-top:0;margin-bottom:0"><?php echo $data->post->title?></h2>
						<i class="glyphicon glyphicon-calendar"></i><span class="date"> <?php echo date('d/m/Y H:i', strtotime($data->post->created_at));?></span>
						<hr>
					</div>
					<div class="col-md-4">


						<div class="col-md-5">
							<a href="#">
								<img data-holder-rendered="true" src="http://insight.venturebeat.com/sites/all/modules/features/vb_intel_analysts/assets/images/analyst-placeholder-avatar.png" alt="Avatar" class="img-thumbnail img-responsive" style="width:100px;height:100px;">
							</a>
						</div>
						<div class="col-md-7" style="margin-left:-35px">
							<a href="#"><?php echo $data->user->firstname, ' ', $data->user->lastname;?></a><br/>
							<span class="date"> Date join: <?php echo date('d/m/Y', strtotime($data->user->created_at))?></span>
						</div>
					</div>

				</div>
				<hr>
				<!-- End about blog -->

				<!-- Content blog -->
				<div class="row">
					<div class="col-md-12" style="padding-bottom: 20px;">
						<?php echo html_entity_decode($data->post->content, ENT_QUOTES, 'UTF-8')?>
					</div>
				</div>
				<!-- End content blog -->

				<!-- Tool for commenting -->
				<div class="row">
					<div class="col-md-12">
						<form action="" method="get" accept-charset="utf-8">
							<textarea id="text-create-comment" class="styled-textarea content_create" name="content" placeholder="Type your comment..."></textarea>
							<input type="hidden" name="post_id" value="<?php echo $data->post->id;?>">
							<div class="container-fluid">
								<div class="row styled-comment">
									<div class="col-md-7 col-sm-6 col-xs-12" style="margin-top:7px;">
										<span style="color:#85C994">
											You have created a comment successfully
										</span>
										<span style="color:#EF4A36">
											You have created a comment unsuccessfully
										</span>
									</div>
									<div class="col-md-2 col-sm-3 col-xs-12 container-menu-icon">
										<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><span class="icon-smiley"></span><span class="caret"></span></a>
										<ul class="dropdown-menu menu-icon-create-comment" role="menu">
											<li>
												<a role="button">
													<span class="icon-smiley"></span>
													<span>SMILEY</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-happy"></span>
													<span>HAPPY</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-tongue"></span>
													<span>TONGUE</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class=" icon-sad"></span>
													<span>SAD</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-wink"></span>
													<span>WINK</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-grin"></span>
													<span>GRIN</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-evil"></span>
													<span>EVIL</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-shocked"></span>
													<span>SHOCKED</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-confused"></span>
													<span>CONFUSED</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-neutral"></span>
													<span>NEUTRAL</span>
												</a>
											</li>
											<li>
												<a role="button">
													<span class="icon-wondering"></span>
													<span>WONDERING</span>
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-12">
										<button type="button" class="btn btn-primary submit_create" style="width:100%;">Create</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- /*End tool for commenting*/ -->
				<?php if($data->total > 0):?>
				<!-- Comments -->
				<div class="row">
					<div class="col-md-12">
						<h4>This post has <?php echo $data->total?> comments:</h4>
						<hr>
					</div>
				</div>
				<?php foreach($data->comments as $v):?>
				<div class="row" style="margin-top:20px;">
					<div class="col-md-12 container-content-comment">
						<div class="avatar-user-comment">
							<img src="<?php echo $v->user->avatar?>" alt="Avatar"style="width:80px;height:80px;">
							<span class="name-user-comment-mobile">
								<a href="#"><?php echo $v->user->firstname, ' ', $v->user->lastname?></a>
							</span>
						</div>
						<div class="content-user-comment">
							<span class="name-user-comment-desktop">
								<a href="#"><?php echo $v->user->firstname, ' ', $v->user->lastname?></a>
							</span>
							<span class="content-comment">
								Cupcake ipsum dolor sit amet chupa chups jelly sesame snaps. Applicake caramels cheesecake icing croissant candy canes donut. Caramels biscuit jujubes icing. Donut cotton candy toffee. Croissant cotton candy applicake cotton candy. Jelly candy canes brownie icing. Danish bonbon carrot cake. Fruitcake jelly beans jelly danish.
								Cupcake ipsum dolor sit amet chupa chups jelly sesame snaps. Applicake caramels cheesecake icing croissant candy canes donut. Caramels biscuit jujubes icing. Donut cotton candy toffee. Croissant cotton candy applicake cotton candy. Jelly candy canes brownie icing. Danish bonbon carrot cake. Fruitcake jelly beans jelly danish.<span class="icon-tongue"></span>
							</span>
							<p>
								<a class="edit-comment" href="#" role="button" data-toggle="modal" data-target="#myModal">Edit</a>&nbsp;-
								<a class="delete-comment" href="#" role="button" data-toggle="modal" data-target="#myModal2">Delete</a>
							</p>
						</div>
					</div>
				</div>
				<?php endforeach;?>
				<?php endif;?>
				<!-- End comments -->

				<!-- Pagination -->
				<div style="margin-left:auto;margin-right:auto;text-align:center;margin:20px;font-size:15px;">
					<a role="button">Show more</a>
				</div>
				<!-- End pagination -->

				<!--Modal Edit-->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content"  style="padding:25px;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Edit below comment</h4>
							</div>
							<div class="modal-body">
								<div class="container-fluid">
									<div class="row">
										<!-- <div class="col-md-12"> -->
										<form action="" method="get" accept-charset="utf-8">
											<textarea id="text-edit-comment" class="styled-textarea" name="comment" placeholder="Type your comment..."></textarea>
											<div class="container-fluid">
												<div class="row styled-comment">
													<div class="col-md-7 col-xs-12" style="margin-top:7px;">
														<span style="color:#85C994">
															You have created a comment successfully
														</span>
													</div>
													<div class="col-md-2 col-xs-12 container-menu-icon">
														<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><span class="icon-smiley"></span><span class="caret"></span></a>
														<ul class="dropdown-menu menu-icon-edit-comment" role="menu">
															<li>
																<a role="button">
																	<span class="icon-smiley"></span>
																	<span>SMILEY</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-happy"></span>
																	<span>HAPPY</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-tongue"></span>
																	<span>TONGUE</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class=" icon-sad"></span>
																	<span>SAD</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-wink"></span>
																	<span>WINK</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-grin"></span>
																	<span>GRIN</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-evil"></span>
																	<span>EVIL</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-shocked"></span>
																	<span>SHOCKED</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-confused"></span>
																	<span>CONFUSED</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-neutral"></span>
																	<span>NEUTRAL</span>
																</a>
															</li>
															<li>
																<a role="button">
																	<span class="icon-wondering"></span>
																	<span>WONDERING</span>
																</a>
															</li>
														</ul>
													</div>
													<div class="col-md-3 col-xs-12">
														<button type="submit" class="btn btn-primary" style="width:100%;">Update</button>
													</div>
												</div>
											</div>
										</form>
										<!-- </div> -->
									</div>
								</div>
							</div>
							<div class="modal-footer"></div>
						</div>
					</div>
				</div>
				<!-- End modal edit -->

				<!--Modal Delete-->
				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content"  style="padding:25px;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Comfirm delete?</h4>
							</div>
							<div class="modal-body" style="text-align:center">
								Are you sure delete this comment?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary">OK</button>
							</div>
						</div>
					</div>
				</div>
				<!--End modal Delete-->

			</div>
			<script>
			//GET CONTENT OF COMMENT TO EDIT
			$('.edit-comment').click(function() {
				var temp_content_comment = $(this).parent().parent().find($('.content-comment')).html();
				var content_comment = temp_content_comment.trim();
				$("#text-edit-comment").val(content_comment);
			});

			//ADD A EMOTION TO TEXTAREA CREATE COMMENT
			$('.menu-icon-create-comment li a').click(function() {
				addEmotion($('#text-create-comment'),$(this));
			});

			//ADD A EMOTION TO TEXTAREA EDIT COMMENT
			$('.menu-icon-edit-comment li a').click(function() {
				addEmotion($('#text-edit-comment'),$(this));
			});

			function addEmotion(container,selector){
				var val_emotion = selector.find($('span:first-child')).attr('class');
				// container.val(container.val()+' ['+val_emotion+"] ");
				container.insertAtCaret(" ["+val_emotion+"] ");
			}

			// INSERTING TEXT AFTER CURSOR POSITION
			jQuery.fn.extend({
				insertAtCaret: function(myValue){
					return this.each(function(i){
						if (document.selection){
      //For browsers like Internet Explorer
      this.focus();
      var sel = document.selection.createRange();
      sel.text = myValue;
      this.focus();
  }
  else if (this.selectionStart || this.selectionStart == '0') {
      //For browsers like Firefox and Webkit based
      var startPos = this.selectionStart;
      var endPos = this.selectionEnd;
      var scrollTop = this.scrollTop;
      this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
      this.focus();
      this.selectionStart = startPos + myValue.length;
      this.selectionEnd = startPos + myValue.length;
      this.scrollTop = scrollTop;
  } else {
  	this.value += myValue;
  	this.focus();
  }
});
				}
			});
		</script>
		<script>
		$(document).ready(function(){
			$('.submit_create').click(function(){
				url = '<?php echo Uri::base()?>create-comment';
				content = $('.content_create').val();
				post_id = $('.post_id').val();
				$.ajax({
					url: url,
					dataType: 'GET',
					data: {content: content, post_id: post_id},
					success: function(){
						alert('ok');
						}
					});
				});
		});
		</script>
		<?php endif;?>