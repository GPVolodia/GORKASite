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
		    	<p id="nav_name"><?php echo $news_edit;?><p>
				<div id="content_writing_style">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
						<div id="profile_inform">
							<form method="post" id="form1" enctype="multipart/form-data">
							<font id="some_cool_font">
								<font style="font-style:italic;"><br></font>
								<?php echo $news_head;?>  :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-font" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="title" value = "<?php echo $current_new[0]['title'] ?>" > 
								</div><br>
								<?php echo $news_descr;?>  :<br>
								<textarea class="textbox1"  name="content" id="textarea_100"   ><?php echo $current_new[0]['content'] ?></textarea><br>
								<br>
								<div id="full">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="margin-20px">
									<?php echo $news_name;?> :<br> 
									<div class="input-group" >
										<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-user" id="glyph_register_height"></span></div>
										<input type="text" class="textbox1" id="my_tb2" name="name" value = "<?php echo $current_new[0]['name'] ?>" >
									</div><br>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="margin-20px" >
									<?php echo $news_surname;?> :<br> 
									<div class="input-group" >
										<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-user" id="glyph_register_height"></span></div>
										<input type="text" class="textbox1" id="my_tb2" name="surname" value = "<?php echo $current_new[0]['surname'] ?>" >
									</div><br>
									</div>
								</div>
								<div id="full">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="margin-20px">
										<?php echo $news_date;?>  :<br> 
										<div class="input-group" >
											<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-calendar" id="glyph_register_height"></span></div>
											<input type="text" class="textbox1" id="my_tb2" name="datetime" value = "<?php echo $current_new[0]['datetime'];?>" > 
										</div><br>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="margin-20px" >
										<?php echo $news_newdate;?> :<br> 
										<div class="input-group" >
											<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-calendar" id="glyph_register_height"></span></div>
											<input type="datetime-local" class="textbox1" id="my_tb2" name="new_date_time" value="">
										</div><br>
									</div>
								</div>
								<?php echo $news_pic;?> : <input type="file" name="filename" id="avatar_button1" > <br>
								<!--Прікрипити відеозапис (необхідно ввести посилання YouTube):<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-film" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="video" value = "<?php echo $current_new[0]['video'] ?>" >
								</div><br>-->
							  	<button form="form1" type="submit" class="btn btn-default" name="submit" value="Підтвердити" id="my_edit_button"><span class="	glyphicon glyphicon-download-alt" id="glyph_edit_profile_height"></span> <?php echo $news_save;?></button>
							</form>
							
							<a class="btn btn-default" id="my_edit_button" href="/news"><span class="glyphicon glyphicon-arrow-left" id="glyph_edit_profile_height"></span> <?php echo $news_back;?></a>
							<a class="btn btn-default" id="my_edit_button" href="/news/edit/<?php echo $current_new[0]['id'];?>"><span class="	glyphicon glyphicon-refresh" id="glyph_edit_profile_height"></span> <?php echo $news_refresh;?></a>
							
							  	
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