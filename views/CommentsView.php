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

		    	<p id="nav_name"><?php echo $comment_name;?><p>
					<div id="content_writing_style">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="register_field_left">
							<font id="some_cool_font">
							<?php if ($comments) : ?>							
							<?php foreach($comments as $comment) : ?>
							<div id="pract_reply_block">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" id="margin-20px">
									<a class="btn btn-default" id="my_edit_button" href="/news/add_comment/<?php echo $comment['id'];?>"><span class="glyphicon glyphicon-ok" id="glyph_edit_profile_height"></span></a>
									
									<!--<a class="btn btn-default" id="my_edit_button" href="/news/edit_comment/<?php// echo $comment['id'];?>"><span class="	glyphicon glyphicon-pencil" id="glyph_edit_profile_height"></span></a>-->
									<a class="btn btn-default" id="my_edit_button" href="/news/delete_comment/<?php echo $comment['id'];?>"><span class="	glyphicon glyphicon-remove" id="glyph_edit_profile_height"></span></a>
								</div>
								<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
									<font id="name_surname_comment"><?php echo $comment_author;?> : </font><?php echo $comment['name'].' '.$comment['surname'];?><br>
									<font id="name_surname_comment">Заголовок новини : </font><?php echo $comment['title'];?><br>
									<font id="name_surname_comment"><?php echo $comment_comment;?> : </font><?php echo $comment['comment'];?><br>
									<font id="name_surname_comment"><?php echo $comment_date;?> : </font><?php echo $comment['datetime'];?>
								</div>
							</div>	
							<?php endforeach;?>
							<?php endif;?>
							</font>
						</div>	
					</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
</body>