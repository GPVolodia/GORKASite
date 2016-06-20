<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<script>
function my_function(argument) {
	xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("demo").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","/functions/function.php?group_students="+argument,true);
    xmlhttp.send();
}
function operation_submit()
{
	document.getElementById("op").innerHTML = "GET_back";
}
</script>
<body>
<?php require_once(ROOT. '/templates/header.php'); ?>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">
		    	<p id="nav_name"><?php echo $course_name;?><p>
					<div id="content_writing_style">
						<font id="comment_more">
						<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<div class="alert alert-info">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Інформація!</strong> Щоб оцінити студента за якесь завдання, оберіть конкретне завдання.
							</div>
							<?php if ($add_group==true):?>
							<div class="alert alert-success fade in">
							    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							    <strong>ОК!</strong> Група була успішно додана на курс.
							</div>
							<?php endif;if ($add_group==false and isset($add_group)) :?>
							<div class="alert alert-danger fade in">
							    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							    <strong>Помилка!</strong> Ви не обрали жодної групи.
							</div>
							<?php endif;?>
							<?php if ($add_student==true):?>
							<div class="alert alert-success fade in">
							    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							    <strong>ОК!</strong> Студент був успішно доданий на курс.
							</div>
							<?php endif;if ($add_student==false and isset($add_student)) :?>
							<div class="alert alert-danger fade in">
							    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							    <strong>Помилка!</strong> Ви не обрали жодного студента.
							</div>
							<?php endif;?>
							<?php foreach($tasks as $task): ?>
								<div id="curr_course_output">
									<font id="curr_course_name"><a href="/courses/<?php echo $course_id;?>/ttask/<?php echo $task['id'];?>"><?php  echo $task['name'];?></a></font><br>
									Опис завдання : <?php echo $task['description']; ?><br>
									Дедлайн : <?php echo $task['date'];?><br>
									Максимальна оцінка : <?php echo $task['max_marc'];?><br>
									<?php if ($task['file']) : ?>
										Прикріплений файл : 
										<a href="Z:/home/localhost/www/files/tasks/<?php echo $task['file']; ?>" download>
										<?php echo $task['file'];?></a>
										
									<?php endif; ?>
								</div>
							<?php endforeach;?>
						</div>
						<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<a class="btn btn-default" id="my_edit_button" style="width:100%;" href="/courses/tjournal/<?php echo $course_id; ?>">Журнал оцінок</a>
							<a class="btn btn-default" style="margin-top:10px;padding-top:5px; width:100%;" id="my_edit_button" href="/courses/<?php echo $course_id; ?>/add_task">Добавити нове завдання</a>

							<div id="right_block">
								<form method="post" id="form1">
									Добавити групу на курс : <br>
									<div class="input-group" style="padding-top:5px;" >
										<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-star-empty" id="glyph_register_height"></span></div>
										<select name="group" size="1" class="textbox2" id="my_tb2">
											<option selected="selected" disabled>Оберіть групу</option>
										<?php foreach($groups as $group) : ?>
										<option value="<?php echo $group['group'];?>"><?php echo $group['group'];?></option>
										<?php endforeach;?>	
										</select>
									</div>
									<input type="submit" value="Добавити" class="btn btn-default" id="right_block_button" onclick="operation_submit()" name="group_submit">	
								</form>
							</div>
							<div id="right_block">
								<form method="post" id="form1">
									Добавити студента на курс. <br>
									Вибрати групу : 
									<div class="input-group" style="padding-top:5px;" >
										<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-star-empty" id="glyph_register_height"></span></div>
										<select name="students_group" onchange="my_function(this.value)" size="1" class="textbox2" id="my_tb2">
											<option selected="selected" disabled>Оберіть групу</option>
										<?php foreach($groups as $group) : ?>
										<option value="<?php echo $group['group'];?>"><?php echo $group['group'];?></option>
										<?php endforeach;?>	
										</select>
									</div>
									Вибрати студента : 
									<div class="input-group" style="padding-top:5px;" >
										<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-star-empty" id="glyph_register_height"></span></div>
										<select name="student_id" size="1" class="textbox2" id="demo">
										</select>
									</div>
									<input type="submit" value="Добавити" class="btn btn-default" id="right_block_button" name="student_submit">	
								</form>
							</div>
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