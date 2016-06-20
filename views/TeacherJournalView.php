<body>
<?php require_once(ROOT. '/templates/header.php'); ?>
<script >
function get_table(argument) {
	var course_id = "<?php echo $course_id?>";
	xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("here_table").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","/functions/function.php?get_table_group="+argument+"&course_id="+course_id,true);
    xmlhttp.send();
}
</script>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">
		    	<p id="nav_name">Журнал оцінок (<?php echo $course_name;?>)<p>
					<div id="content_writing_style">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="register_field_left">
							<font id="some_cool_font">
							<!--<form method="post" id="form1">
								Оберіть групу для виведення оцінок : 		
								<select name="group" onchange="get_table(this.value)" size="1" class="textbox_real_def" id="textbox_real_id">
									<option selected="selected" disabled>Оберіть групу</option>
								<?php //foreach($groups as $group) : ?>
								<option value="<?php //echo $group['group'];?>"><?php //echo $group['group'];?></option>
								<?php //endforeach;?>	
								</select>
							</form>-->
							<table class="table table-responsive bootgrid-table" id="marks_table">
								<thead>
									<tr>
										<th>Ім'я</th>
										<th>Прізвище</th>
										<th>Група</th>
										<?php 
											$task_numb = 0;
											foreach( $stud_groups[0]['tasks'] as $task )
											{
												echo '<th>'.$task.'</th>';
												$task_numb++;
											}
										?>
										<th>&#8721;</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										//var_dump($student_mark_list);
										for($i=0; $i<$students; $i++)
										{
											$summ = 0;
											echo '<tr>';
											echo '<td>'.$stud_groups[$i]['name'].'</font>';
											echo '<td>'.$stud_groups[$i]['surname'].'</font>';
											echo '<td>'.$stud_groups[$i]['stud_group'].'</font>';
											for ($j=0; $j<$task_numb; $j++)
											{
												$summ+=$stud_groups[$i]['mark'][$j];
												if (!is_numeric($stud_groups[$i]['mark'][$j])) 
													echo '<td>0</td>';
												else
													echo '<td>'.$stud_groups[$i]['mark'][$j].'</td>';
											}
											echo '<td>'.$summ.'</font>';
											echo '</tr>';
										}
									?>
								</tbody>
							</table>
							</font>
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