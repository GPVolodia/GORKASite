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
		    	<p id="nav_name"><?php echo $course_name;?> <a href="/courses/sjournal/<?php echo $course_id;?>">(Переглянути журнал оцінок)</a><p>
					<div id="content_writing_style">

						<font id="comment_more">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<div class="alert alert-info fade in">
							    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							    <strong>Підсказка!</strong> Для перегляду журналу оцінок, натисніть на посилання , яке знаходиться в заголовку.
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
									<font id="curr_course_name"><a href="/courses/<?php echo $course_id; ?>/task/<?php echo $task['id'];?>"><?php  echo $task['name'];?></a></font><br>
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