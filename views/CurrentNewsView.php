<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<body>
<?php require_once(ROOT. '/templates/header.php'); ?>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">

		    	<p id="nav_name"> <?php echo $cur_new_name;?><p>
					<div id="content_writing_style">
						<?php foreach($current_new as $cur_new) : ?>
						<div id="news_element">
							<div class="comment more" id="comment_more">
								<?php echo $cur_new['content']; ?>
							</div>
							<?php if ($cur_new['picture']) : ?>
							<div id="news_list_picture">
							<?php echo '<img src="/documents/news/'.$cur_new['picture'].'"" class="img-rounded" id="news_list_picture">'; ?>
							</div>		
							<?php endif;?>
							<?php if ($cur_new['video']) : ?>
								<div class="responsive-video">
									<?php if ($cur_new['video']) echo '<iframe title="YouTube video player" width="501" height="346" src="'.$cur_new['video'].'"  frameborder="0" allowfullscreen></iframe><br>';?>
								</div>
							<?php endif;?> <br>
							<font id="news_list_author"><?php echo $current_new_author;?> : </font>
							<font id="news_list_author_write"><?php echo $cur_new['name'].' '.$cur_new['surname']; ?></font>
							<font id="news_list_author"> ,  <?php echo $current_new_date;?> : </font>
							<font id="news_list_author_write"><?php echo $cur_new['datetime'];?></font>
						</div>
						<?php endforeach;?>
						
						<?php foreach($comments as $comment) : ?>
						<div id="pract_reply_block">
							<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
								<div id="pract_reply_block_avatar">
									<img src="/images/avatar/<?php echo $comment['avatar'].'.jpg'; ?>"  alt="" id="comment_avatar" >
								</div>
							</div>
							<font id="some_cool_font">
							<div class="col-lg-9 col-md-8 col-sm-8 col-xs-8">
								<div id="pract_reply_block_message">
									<font id="name_surname_comment">
										<?php echo $comment['name'].' '.$comment['surname']; ?>
									</font> <br>	
									<?php echo $comment['reply']; ?><br><br>
									<?php echo $comment['datetime'];?>
								</div>
							</div>
							</font>
						</div>
						<?php endforeach; ?>

						<?php if ($_SESSION['user_id']!=0) : ?>
							<form method="post" id="form1" enctype="multipart/form-data">
							<font id="some_cool_font">
								<?php echo $current_new_addcom;?>  :<br>
								<textarea class="textbox1"  name="content" id="textarea_100"   ></textarea><br>
								<br>								
							  	<button form="form1" type="submit" class="btn btn-default pull-right" name="submit" value="Підтвердити" id="my_edit_button"><span class="	glyphicon glyphicon-list-alt" id="glyph_edit_profile_height"></span> <?php echo $current_new_addcom;?></button><br><br><br>
							  
							</form>
						<?php endif;?>


					</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
</body>