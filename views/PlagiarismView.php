<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<script type="text/javascript">
function get_task(argument)
{
	xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("task_list").innerHTML = xmlhttp.responseText;
        }
    };
    alert(argument);
    xmlhttp.open("GET","/functions/function.php?get_task="+argument,true);
    xmlhttp.send();
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

		    	<p id="nav_name">Перевірка алгоритму на плагіат<p>
					<div id="content_writing_style">
						<form method="post" id="form1">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="register_field_left">
								<textarea class="textbox1"  name="content" id="textarea_alg" rows="1000"></textarea><br>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="register_field_left">
								
									Оберіть курс : 
									<select name="course_id" size="1" class="textbox2" id="my_tb2">
										<option selected="selected" disabled>Оберіть групу</option>
										<?php foreach($courses as $course) : ?>
										<option value="<?php echo $course['course_id'];?>"><?php echo $course['course_name'];?></option>
										<?php endforeach;?>	
									</select>
									Впишіть ім'я та прізвище студента : <br>
									<input type="text" name="student" class="textbox2" id="my_tb2">
									<input type="submit" value="Добавити" class="btn btn-default" id="right_block_button" name="student_submit">	
								
							</div>
						</form>		
					</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
</body>