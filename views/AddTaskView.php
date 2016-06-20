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
		    	<p id="nav_name">Створити завдання<p>
				<div id="content_writing_style">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
						<div id="profile_inform">
							<form method="post" id="form1" enctype="multipart/form-data">
							<font id="some_cool_font">
								Назва завдання :<br> 
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-font" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="name" value = "<?php echo $current_new[0]['title'] ?>" > 
								</div><br>
								Опис завдання  :<br>
								<textarea class="textbox1"  name="description" id="textarea_100"   ><?php echo $current_new[0]['content'] ?></textarea><br>
								<br>
								<div id="full">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="margin-20px">
										Дата здачі завдання :<br> 
										<div class="input-group" >
											<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-calendar" id="glyph_register_height"></span></div>
											<input type="datetime-local" class="textbox1" id="my_tb2" name="date" value="">
										</div><br>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="margin-20px" >
										Максимальна оцінка :<br> 
										<div class="input-group" >
											<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-bookmark" id="glyph_register_height"></span></div>
											<input type="text" class="textbox1" id="my_tb2" name="max_marc" value = "<?php echo $current_new[0]['title'] ?>" > 
										</div><br>
									</div>
								</div>
								<br>
								Тип перевірки : 
								<select name="type" class="textbox1" id="my_tb2">
									<option value="0">Перевірка тексту</option>
									<option value="1">Перевірка алгоритму</option>
								</select><br>
								<br>
								Прикріпити файл : <input type="file" name="filename" id="avatar_button1" > <br>
							  	<button form="form1" type="submit" class="btn btn-default" name="submit" value="Підтвердити" id="my_edit_button"><span class="glyphicon glyphicon-floppy-disk" id="glyph_edit_profile_height"></span> Створити завдання</button>
							</form>
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