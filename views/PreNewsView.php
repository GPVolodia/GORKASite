<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<?php require_once(ROOT. '/templates/header.php'); ?>
<body>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">

		    	<p id="nav_name"> <?php echo $_POST['title'];?> (<?php echo $prew_title;?>) <p>
					<div id="content_writing_style">
						<?php $user_id=$_SESSION['user_id']; ?>
							<div class="comment more" id="comment_more">
								<?php echo $_POST['content']; ?>
							</div><br>
							<?php if ($_FILES['filename']['name']) : ?>
							<div id="news_list_picture">
								<?php $image = $_FILES['filename']['name'];?>
								<?php echo '<img src="/documents/news/'.$image.'" class="img-rounded" id="news_list_picture">'; ?>
							</div>		
							<?php endif;?>
							<br>
						<button form="form" type="submit" class="btn btn-default" onclick="history.back();" name="preview" value="Підтвердити" id="my_edit_button"><span class="	glyphicon glyphicon-arrow-left" id="glyph_edit_profile_height"></span> <?php echo $prew_back;?></button>
						<form method="post" id="forma">
							<button form="forma" type="submit" class="btn btn-default pull-right"  name="bitch" value="Підтвердити" id="my_edit_button"><span class="	glyphicon glyphicon-list-alt" id="glyph_edit_profile_height"></span> <?php echo $prew_publish;?></button><br><br>
						</form>
					</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
</body>