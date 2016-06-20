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
		    	<p id="nav_name"><?php echo $write_ne;?><p>
				<div id="content_writing_style">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
						<div id="profile_inform">
							<form method="post" id="form1" enctype="multipart/form-data">
							<font id="some_cool_font">
								<?php echo $write_head;?>  :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-font" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="title" value = "<?php echo $current_new[0]['title'] ?>" > 
								</div><br>
								<?php echo $write_cont;?>  :<br>
								<textarea class="textbox1"  name="content" id="textarea_100"   ><?php echo $current_new[0]['content'] ?></textarea><br>
								<br>
								<?php echo $write_date;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-calendar" id="glyph_register_height"></span></div>
									<input type="datetime-local" class="textbox1" id="my_tb2" name="new_date_time" value="">
								</div><br>
								<?php echo $write_pic;?> : <input type="file" name="filename" id="avatar_button1" > <br>
								<?php echo $write_video;?>:<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-film" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="video" value = "<?php echo $current_new[0]['video'] ?>" >
								</div><br>
							  	<button form="form1" type="submit" class="btn btn-default" name="submit" value="Підтвердити" id="my_edit_button"><span class="	glyphicon glyphicon-list-alt" id="glyph_edit_profile_height"></span> <?php echo $write_ne;?></button>
							  	<button form="form1" type="submit" class="btn btn-default" name="preview" value="Підтвердити" id="my_edit_button"><span class="	glyphicon glyphicon-eye-open" id="glyph_edit_profile_height"></span> <?php echo $write_pre;?></button>
							</form>
							
							<a class="btn btn-default" id="my_edit_button" href="/news"><span class="glyphicon glyphicon-arrow-left" id="glyph_edit_profile_height"></span> <?php echo $write_back;?></a>
							<!--<a class="btn btn-default" id="my_edit_button" href="/news/edit/<?php //echo $current_new[0]['id'];?>"><span class="	glyphicon glyphicon-eye-open" id="glyph_edit_profile_height"></span> Попередній перегляд</a>-->
							
							  	
						</div>
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