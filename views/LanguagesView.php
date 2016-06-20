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

		    	<p id="nav_name">Додання мови<p>
					<div id="content_writing_style">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="register_field_left">
							<form method="post">
								<font id="some_cool_font">
								Для того, щоб додати мову, введіть переклад головних блоків сайту.
								Та нажміть кнопку підтвердити.<br><br>
								<div id="nvirnnvr">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Назва мови (UA, EN) :</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> <input type="text" class="textbox1" name="language_name" id="my_tb2" value = "" ></div>
								</div><br><br>
								<?php foreach ($langa as $key => $value) :?>
						    		<?php //echo "Ключ: $key; Значение: $value<br />";?>
						    	<?php 
						    		$value = trim($value);
						    	?>
						    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo substr($value, 1 , strlen($value)-3); ?> : 	</div> 
						    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><input type="text" class="textbox1" name="<?php echo $key;?>" id="my_tb2" value = "" ></div><br><br>
								<?php endforeach;?>
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