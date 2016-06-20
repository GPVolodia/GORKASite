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

		    	<p id="nav_name"><?php echo $log_head;?><p>
					<div id="content_writing_style">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="register_field_left">
							<?php if ($message == -1) :?>
								<div class="alert alert-info fade in">
								    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								    <strong>Помилка!</strong> Логін або пароль були введені неправильно.
								</div>
							<?php endif;?>
							<form method="post">
								<font id="some_cool_font">
								<?php echo $log_login;?><br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-knight" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="login" value = "<?php echo $_POST['login'] ?>" >
								</div><br>
								<!--ѕов?домленн¤ :<br> 
								<textarea id="textarea1" name="message" rows="8" cols="50"></textarea><br>-->
								<?php echo $log_pass;?><br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-exclamation-sign" id="glyph_register_height"></span></div>
									<input type="password" class="textbox1" name="l_password" id="my_tb2" value = "<?php echo $_POST['l_password'] ?>" >
								</div><br>
								
								<input type="submit" value="<?php echo $log_subm;?>" name="submit" id="my_sb1"></font>
							</form>
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