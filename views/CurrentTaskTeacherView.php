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
function get_table(argument) {
	var course_id = "<?php echo $course_id?>";
	var task_id = "<?php echo $task_id?>";
	xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("here_table").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","/functions/function.php?get_group_student_list="+argument+"&task_id="+task_id+"&course_id="+task_id,true);
    xmlhttp.send();
}

function check_mark(argument)
{
	var max_mark = +"<?php echo $task['max_marc'];?>";
	
	if (argument <= max_mark)
	{
		return true;
	}
	else 
	{
		alert('Ви перевищили максимально можливу оцінку.');
		return false;
	}
	
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
							Опис завдання : <?php echo $task['description']; ?><br>
							Дедлайн : <?php echo $task['date'];?><br>
							Максимальна оцінка за роботу: <?php echo $mark.''.$task['max_marc'];?><br>
							<?php if ($task['file']) : ?>
								Прикріплений файл до завдання : 
								<a href="Z:/home/localhost/www/files/tasks/<?php echo $task['file']; ?>" download>
								<?php echo $task['file'];?></a>
							<?php endif; ?>
							<br>
							<a href="/task/edit/<?php echo $task['id'];?>">Редагувати завдання</a> ,
							<a href="/task/delete/<?php echo $task['id'];?>"> Видалити завдання</a><br><br>
							<!--<form method="post" id="form1">
								Оберіть групу для виведення списка студетів : 		
								<select name="group" onchange="get_table(this.value)" size="1" class="textbox_real_def" id="textbox_real_id">
									<option selected="selected" disabled>Оберіть групу</option>
								<?php //foreach($groups as $group) : ?>
								<option value="<?php //echo $group['group'];?>"><?php //echo $group['group'];?></option>
								<?php //endforeach;?>	
								</select>
							</form>
							-->
							<table class="table table-responsive bootgrid-table" id="marks_table">
								<thead>
									<tr>
										<th>Ім'я</th>
										<th>Прізвище</th>
										<th>Група</th>
										<th>Робота</th>
										<th>Оцінка плагіату(%)</th>
										<th>Оцінка</th>
										<th>Поставити оцінку</th>
										<th>Плагіат</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($table as $row) : ?>
										<tr>
											<td><?php echo $row['name']?></td>
											<td><?php echo $row['surname']?></td>
											<td><?php echo $row['stud_group']?></td>
											<?php if ($row['work']) : ?>
												<td><a href="<?php echo $work_root;?>" download="<?php echo $row['work'];?>"><?php echo $row['work']?></a></td>
											<?php else : ?>
												<td>-</td>
											<?php endif;?>
											<td>
												<?php if ($row['coef']) : ?>
													<?php echo $row['coef'].' '; ?>
												<?php else : ?> 
													<?php echo '-';?>
												<?php endif;?>
											</td>
											<?php if($row['mark']) :?>
												<td><?php echo $row['mark']?></td>
											<?php else : ?>
												<td>0</td>
											<?php endif;?>
											<td><form name="form1" method="post" onsubmit="return check_mark(mark.value);">
												<input type="hidden" id="no_width" name="user_id" value="<?php echo $row['id'];?>">
												<input type="text" id="small_text_field" name="mark" value="">
												<input type="submit" value="Оцінити" id="right_blocK_button_default2">
											</form></td>
											<td >
												<form name="form1" method="post">
													<input type="hidden" id="no_width" name="work" value="<?php echo $row['work'];?>">
													<input type="hidden" id="small_text_field" name="task_id" value="<?php echo $task['id'];?>">
													<input type="submit" name="check_plagiarism" value="Обрахувати" id="right_blocK_button_default2">
												</form>
											</td>
										</tr>
									<?php endforeach;?>
		
								</tbody>
							</table>
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