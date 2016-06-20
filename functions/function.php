<?php 
session_start();
require_once ('Z:/home/localhost/www/components/Db.php');
require_once ('Z:/home/localhost/www/models/UserModel.php');
require_once ('Z:/home/localhost/www/models/JournalModel.php');
?>
<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
<script>
function showEdit() {
	alert("yes");
	//$(editableObj).css("background","white");
} 

function saveToDatabase(editableObj,column,id) {
	$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
	$.ajax({
		url: "saveedit.php",
		type: "POST",
		data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
		success: function(data){
			$(editableObj).css("background","#FDFDFD");
		}        
   });
}
</script>
<?php
$bd = DB::connect();
$dir = dirname(__DIR__);
if ($_GET['role_description'])
{
	$role_id = $_GET['role_description'];
	$query_get_right = mysql_query("SELECT distinct role.id_right, rights.name FROM role 
		LEFT JOIN rights ON role.id_right = rights.id
		WHERE role.name = '$role_id'");
	echo 'Має наступні права : <br>';
	while ($row = mysql_fetch_array($query_get_right))
	{
		echo $row['name'].'<br>';
	}
	echo '<br>';
}

if ($_GET['people_list'])
{
	$my_id = $_SESSION['user_id'];
	$some_mes = $_GET['people_list'];
	if ($some_mes !== "full_list_people")
		$query_get_people_by_name = mysql_query("SELECT * FROM users WHERE name LIKE '%$some_mes%'");
	else
		$query_get_people_by_name = mysql_query("SELECT * FROM users WHERE not id='$my_id'");
	$people_list_arr = array();
	$i = 0;
	while ($row_by_name = mysql_fetch_array($query_get_people_by_name))
	{
		$people_list_arr[$i]['name'] = $row_by_name['name'];
		$people_list_arr[$i]['surname'] = $row_by_name['surname'];
		$people_list_arr[$i]['avatar'] = $row_by_name['avatar'];
		$i++;
	}
	require_once($dir. '/dynamic_view/people_list.php');
}

if ($_GET['message_theme'] and $_GET['message_content'])
{
	
	echo $_GET['message_theme'];
	echo $_GET['message_content'];
}

if ($_GET['add_friend'])
{
	$id_friend = $_GET['add_friend'];
	//echo "motherfucker"."+".$id_friend;
	$my_id = $_SESSION['user_id'];
	$query_add_friend = mysql_query("INSERT INTO friends(id_user, id_friend) VALUES ($my_id, $id_friend)");
}

if ($_GET['delete_friend'])
{
	$id_friend = $_GET['delete_friend'];
	//echo "motherfucker"."+".$id_friend;
	$my_id = $_SESSION['user_id'];
	$query_delete_friend = mysql_query("DELETE FROM friends WHERE id_user = '$my_id' AND id_friend='$id_friend'");
}

if ($_GET['group_students'])
{
	$group = $_GET['group_students'];
	$students = UserModel::get_all_students($group);
	var_dump($students);
	foreach($students as $student) 
	{
		echo '<option value="'.$student['id'].'">';echo $student['name'].' '.$student['surname'];echo '</option>';
	}

}

if ($_GET['get_task'])
{
	$course = $_GET['get_task'];
	$tasks_ = CoursesModel::get_all_tasks($course);
	//var_dump($students);
	foreach($tasks_ as $tasks) 
	{
		echo '<option value="'.$tasks['id'].'">';echo $tasks['name']; echo '</option>';

	}
	

}

if($_GET['get_table_group'] and $_GET['course_id'])
{
	$my_group = $_GET['get_table_group'];
	$my_course_id = $_GET['course_id'];
	$stud_groups = JournalModel::get_group_mark($my_group, $my_course_id );
	$students = count($stud_groups);
	
	echo '<thead><tr><th><font id="some_cool_font">Імя</font></th>';
	$task_numb = 0;
	foreach( $stud_groups[0]['tasks'] as $task )
	{
		echo '<th><font id="some_cool_font">'.$task.'</font></th>';
		$task_numb++;
	}
	echo '<th><font id="some_cool_font">&Sigma;</font></th>';
	echo	'</tr></thead><tbody>';
	for($i=0; $i<$students; $i++)
	{
		$summ = 0;
		echo '<tr>';
		echo '<td><font id="some_cool_font">'.$stud_groups[$i]['name'].' '.$stud_groups[$i]['surname'].'</font>';
		for ($j=0; $j<$task_numb; $j++)
		{
			$summ+=$stud_groups[$i]['mark'][$j];
			if (!is_numeric($stud_groups[$i]['mark'][$j])) 
				echo '<td contenteditable="true" onclick="showEdit();" ><font id="some_cool_font">0</font></td>';
			else
				echo '<td contenteditable="true" onclick="showEdit();" ><font id="some_cool_font">'.$stud_groups[$i]['mark'][$j].'</font></td>';
		}
		echo '<td><font id="some_cool_font">'.$summ.'</font>';
		echo '</tr>';
	}
	echo '</tbody>';
}
if ($_GET['get_group_student_list'] && $_GET['task_id'])
{
	var_dump($_GET);
	$id = $_GET['course_id'];
	$id_task = $_GET['task_id'];
	$list_stud = array();
	$group = $_GET['get_group_student_list'];
	$query1 = mysql_query("SELECT users.name, users.surname, journal.mark FROM users 
		LEFT JOIN users_course ON users_course.id_user = users.id 
		LEFT JOIN task ON users_course.id_course = task.id_course
		LEFT JOIN journal ON journal.id_task = task.id
		WHERE users_course.id_course = '$id' AND users.stud_group = '$group' AND task.id='$id_task'");
	while($row = mysql_fetch_array($query1))
	{
		if ($row['mark'])
			$list_stud['mark'] = $row['mark'];
		else 
			$list_stud['mark'] = 0;
		$list_stud[]=$row;
	}
	var_dump($list_stud);
	echo '<thead><tr><th><font id="some_cool_font">Студент</font></th>';
	echo '<th><font id="some_cool_font">Оцінка</font></th>';
	echo	'</tr></thead><tbody>';
	foreach($list_stud as $el)
	{
		echo '<tr>';
		echo '<td><a href="/put_mark/task_id/'.$id_task.'/user_id/'.$el['id'].'">';
		echo $el['name'].' '.$el['surname'];
		echo '</td></a>';
		//if (!is_numeric($el['mark'])) 
		//		echo '<td><font id="some_cool_font">0</font></td>';
		//	else
				echo '<td><font id="some_cool_font">'.$el['mark'].'</font></td>';
		echo '</tr>';
	}
	echo '</tbody>';
}


?>
<script type="text/javascript">
function operation_ok() {
	alert("x");
    document.getElementById("operation_success").innerHTML = "xmlhttp.responseText";
}
</script>
