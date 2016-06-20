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
										<th>Завдання</th>
										<th>Оцінка</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										//var_dump($student_mark_list);
										$summ = 0;
										for($i=0; $i<count($list_marks); $i++)
										{
											
											echo '<tr>';
											echo '<td>'.$list_marks[$i]['name'].'</td></font>';
											if ($list_marks[$i]['mark'])
											{
												echo '<td>'.$list_marks[$i]['mark'].'</td></font>';
												$summ += $list_marks[$i]['mark'];
											}
											else
												echo '<td>0</td></font>';
											
											echo '</tr>';
										}

									?>
									<tr style="background:#303030;">
										<td>Сума</td>
										<td><?php echo $summ;?></td>
									</tr>
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