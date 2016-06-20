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
		    	<p id="nav_name">Управління курсами<p>
					<div id="content_writing_style">
						<font id="comment_more">
						<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<?php foreach($user_courses as $cours): ?>
								<div id="curr_course_output">
									<font id="curr_course_name"><a href="/courses/<?php echo $cours['course_id']; ?>"><?php  echo $cours['course_name'];?></a></font><br>
									Викладач : <?php echo $cours['teacher_name']; ?> <?php echo " "; ?><?php echo $cours['teacher_surname'];?>
									<br><br><a onclick="return confirm('Справді видалити курс?');"href="/courses/delete/<?php echo $cours['course_id'];?>">Видалити курс</a>
								</div>
							<?php endforeach;?>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<!--<font id="big_title">Прибрати права викладача у користувача.</font><br><br>-->
							<font id="underline_font_28px">Створити новий курс : </font>
							<form method="post" id="form2">
								<br>
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-list-alt" id="glyph_register_height"></span></div>
									<input type="text" class="textbox1" id="my_tb2" name="course_name" value = "<?php echo $_POST['user_name'] ?>" > 
								</div><br>
							<button form="form2" value="Підтвердити" name="delete_teacher" type="submit" class="btn btn-default" id="my_edit_button"><span class="glyphicon glyphicon-ok" id="glyph_edit_profile_height"></span> <?php echo "Створити курс";?></button>
							</form>
						</div>
						</font>
					</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
</body>