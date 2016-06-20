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

		    	<p id="nav_name"><?php //echo $reg_reg;?>Мої друзі<p>
					<div id="content_writing_style">
						<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12" id="register_field_left">
							<form method="post">
								<font id="some_cool_font">
								<?php echo $reg_name;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-user" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="user_name" value = "<?php echo $_POST['user_name'] ?>" > 
								</div><br>
								<?php echo $reg_sur;?> :<br>
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-user" id="glyph_register_height"></span></div>
									 <input type="text" class="textbox1" id="my_tb2" name="surname" value = "<?php echo $_POST['surname'] ?>" > 
								</div>
								<br>
								<?php echo $reg_mail;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-envelope" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="mail" value = "<?php echo $_POST['mail'] ?>" >
								</div><br>
								<?php echo $reg_pos;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-asterisk" id="glyph_register_height"></span></div>
									<select name="position" size="1" class="textbox2" id="my_tb2">
										<option value="student">Студент</option>
										<option value="teacher">Викладач</option>
									</select>
								</div><br>									
								
								<?php echo $reg_log;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-knight" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="login" value = "<?php echo $_POST['login'] ?>" >
								</div><br>
								<!--ѕов?домленн¤ :<br> 
								<textarea id="textarea1" name="message" rows="8" cols="50"></textarea><br>-->
								<?php echo $reg_pass;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-exclamation-sign" id="glyph_register_height"></span></div>
									<input type="password" class="textbox1" name="l_password" id="my_tb2" value = "<?php echo $_POST['l_password'] ?>" >
								</div><br>
								<?php echo $reg_pass_pass;?> :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-exclamation-sign" id="glyph_register_height"></span></div>
									<input type="password" class="textbox1" name="r_password" id="my_tb2" value = "<?php echo $_POST['r_password'] ?>" >
								</div><br>
								<input type="submit" value="<?php echo $log_subm;?>" name="submit" id="my_sb1"></font>
							</form>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12" id="register_field_right">
						<?php if (count($message) >= 1 ) : ?>
							<font id="some_cool_font"><p id="register_error_title">Вииникли помилки при реєстрації</p></font>
							<?php foreach($message as $cur_message) : ?>
								<font id="some_cool_font">
								<p id="register_error">
								<?php echo $cur_message;?>
								<br></p></font>
							<?php endforeach; ?>
						<?php else : ?>
							<font id="some_cool_font"><p id="register_success_title">Вітаємо, ви були зареєстровані на сайті.</p></font>
							<img src="/images/OK.png" class="img-responsive">
						<?php endif; ?>
						
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