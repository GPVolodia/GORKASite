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

		    	<p id="nav_name"><?php echo $feed_lang;?><p>
					<div id="content_writing_style">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="register_field_left">
							<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id="margin-20px">
								<div style="width:100%; float:left;">
									<?php echo '<img src="/images/developers/gorkas.jpg"  class="img-thumbnail" alt="" id="profile_avatar" >';?>
								</div>
							<br><br>
							</div>

							<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="margin-20px">
								<div id="profile_inform">
									<font id="developer_name">Горобюк Володимир Петрович<br></font>
									<font id="developer_info">cтудент групи ІС-31<br>
									НТУУ "КПІ", ФІОТ, АСОІУ 3 курс<br>
									Телефон : 096 621 4693<br>
									Пошта : <a href="">volodia2506@gmail.com</a></font>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="register_field_left">
							<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id="margin-20px">
								<div style="width:100%; float:left;">
									<?php echo '<img src="/images/developers/kasgor.jpg" class="img-thumbnail" alt="" id="profile_avatar" >';?>
								</div>
							<br><br>
							</div>

							<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="margin-20px">
								<div id="profile_inform">
									<font id="developer_name">Касянчик Дмитро Олександрович<br></font>
									<font id="developer_info">cтудент групи ІС-32<br>
									НТУУ "КПІ", ФІОТ, АСОІУ 3 курс<br>
									Телефон : 097 192 6781<br>
									Пошта : <a href="">dikape03@gmail.com</a></font>
								</div>
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