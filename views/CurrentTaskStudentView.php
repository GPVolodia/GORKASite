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
		    	<p id="nav_name"><?php echo $task['name'];?><p>
					<div id="content_writing_style">
						<font id="comment_more">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<?php if (!$deadline_ok):?>
							<div class="alert alert-danger fade in">
							    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							    <strong>Занадто пізно!</strong> Нажаль дедлайн до даного завдання вийшов. Ви не маєте змоги прикріпити роботу.
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
							Опис завдання : <?php echo $task['description']; ?><br>
							Дедлайн : <?php echo $task['date'];?><br>
							Оцінка за роботу: <?php echo $mark.'/'.$task['max_marc'];?><br>
							<?php if ($task['file']) : ?>
								Прикріплений файл до завдання : 
								<a href="Z:/home/localhost/www/files/tasks/<?php echo $task['file']; ?>" download>
								<?php echo $task['file'];?></a>
							<?php endif; ?>
							
							<?php if ($student_work):?>
								<br>Ваша робота : <a href="<?php echo $student_work_href;?>" download> <?php echo $student_work;?></a>
								<br><br>
								<?php if ($deadline_ok):?>
									<form method="post" enctype="multipart/form-data">
										<div id="CTSV1" style="margin-bottom:5px;"><font style="border-bottom:solid 1px grey;">Редагувати роботу (завантажити новий файл): </font></div><input name="filename" type="file" >
										<input type="submit" value="Обновити роботу" class="btn btn-default" id="right_block_button_default" name="submit_work">
									</form>
								<? endif;?>
							<?php else:?> 
								<br><br>
								<?php if ($deadline_ok):?>
									<form method="post" enctype="multipart/form-data">
										<div id="CTSV1" style="margin-bottom:5px;"><font style="border-bottom:solid 1px grey;">Прикріпити роботу: </font></div><input name="filename" type="file" >
										<input type="submit" value="Добавити роботу" class="btn btn-default" id="right_block_button_default" name="submit_work">
									</form>
								<?php endif;?> 
							<?php endif;?>





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