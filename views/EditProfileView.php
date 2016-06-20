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
		    	<p id="nav_name"><?php echo $edit_prof;?><p>
				<div id="content_writing_style">
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id="margin-20px">
						<div id="profile_avatar">
							<?php echo '<img src="/images/avatar/'.$information['avatar'].'.jpg"  alt="" id="profile_avatar" >';?>
						</div>
						<br><br>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="margin-20px">
						<div id="profile_inform">
							<form method="post" id="form1" enctype="multipart/form-data">
							<font id="some_cool_font">


								<?php echo $edit_na;?>  :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-user" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="user_name" value = "<?php echo $information['name'] ?>" > 
								</div><br>
								<?php echo $edit_sur;?>  :<br>
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-user" id="glyph_register_height"></span></div>
									 <input type="text" class="textbox1" id="my_tb2" name="surname" value = "<?php echo $information['surname'] ?>" > 
								</div>
								<br>
								<?php echo $edit_mail;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-envelope" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="mail" value = "<?php echo $information['mail'] ?>" >
								</div><br>
								
								<?php echo $edit_login;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-knight" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="login" value = "<?php echo $information['login'] ?>" >
								</div><br>

								<?php echo $edit_av;?> : <input type="file" name="filename" id="avatar_button1" > <br>
								<!--ѕов?домленн¤ :<br> 
								<textarea id="textarea1" name="message" rows="8" cols="50"></textarea><br>-->
								<!--Пароль :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-exclamation-sign" id="glyph_register_height"></span></div>
									<input type="password" class="textbox1" name="l_password" id="my_tb2" value = "<?php //echo $_POST['l_password'] ?>" >
								</div><br>
								Підтвердження пароля :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-exclamation-sign" id="glyph_register_height"></span></div>
									<input type="password" class="textbox1" name="r_password" id="my_tb2" value = "<?php //echo $_POST['r_password'] ?>" >
								</div><br>-->
								
							  	<button form="form1" type="submit" class="btn btn-default" id="my_edit_button"><span class="	glyphicon glyphicon-download-alt" id="glyph_edit_profile_height"></span> <?php echo $news_save;?></button>
							  	
								
								
							</form>
							
							<a class="btn btn-default" id="my_edit_button" href="/profile"><span class="		glyphicon glyphicon-arrow-left" id="glyph_edit_profile_height"></span> <?php echo $news_back;?></a>
							
							  	
						</div>
						
						<?php if ($error_list) : ?>
							<br><span style="color:#202020;">.</span><br>
							<div class="alert alert-danger fade in">
								    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php foreach($error_list as $error) : ?>
									<?php if ($error != null ) :?> 
								    <strong>Помилка!</strong> <?php echo $error;?><br>
									<?php endif;?>
								<?php endforeach;?>
							</div>
						<?php endif;?>
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