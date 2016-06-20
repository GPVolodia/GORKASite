<?php 

class TaskController
{
	public static function actionAddTask($course_id)
    {
        if ($_POST)
        	if ($_POST['name'])
        		$add_task = TaskModel::add_task($_POST, $course_id);  
		require_once(ROOT. '/views/AddTaskView.php');
    }

    public static function actionDeleteTask($task_id)
    {
    	$t_id = $task_id;
    	$bd = DB::connect();
    	$query = mysql_query("DELETE FROM task WHERE id='$task_id'");
    	header('Location: /courses');
    }

    public static function actionEditTask($task_id)
    {
    	$task = TaskModel::get_current_task($task_id);
    	if ($_POST)
    		TaskModel::edit_task($_POST, $task_id);
    	require_once(ROOT. '/views/EditTaskView.php');
    }

    public static function actionCurrentTask($course_id, $task_id)
    {
    	
    	$user_id = $_SESSION['user_id'];
    	if ($_POST['submit_work'])
		{
			$submit_work = WorkModel::submit_work($_FILES, $_POST, $task_id, $user_id);
			
		}
    	$task = TaskModel::get_current_task($task_id);
    	$mark = JournalModel::get_task_student_mark($task_id, $user_id);
		$student_work = WorkModel::get_task_work($task_id, $user_id);
		$today = date("Y-m-d H:i:s");
		if ($today <= $task['date'])
			$deadline_ok = true;
		
		$student_work_href = ROOT.'/task/'.$student_work;
		
    	require_once(ROOT. '/views/CurrentTaskStudentView.php');


    }

	public static function actionTeacherCurrentTask($course_id, $task_id)
    {
    	
    	/*$user_id = $_SESSION['user_id'];
    	
    	$groups = UserModel::get_all_groups();*/
    	if ($_POST)
    	{
    		//var_dump($_POST);
    		if ($_POST['check_plagiarism'])
    		{
    			extract($_POST);
    			$check_plagiarism = TaskModel::check_plagiarism($task_id, $work);
    			//$coef = $check_plagiarism;
    			$coef = number_format($check_plagiarism, 2, '.','');
    		}
    		$put_mark = JournalModel::put_mark($_POST, $task_id);
    	}

    	$task = TaskModel::get_current_task($task_id);
    	/*$mark = JournalModel::get_task_student_mark($task_id, $user_id);
		$student_work = WorkModel::get_task_work($task_id, $user_id);
		$today = date("Y-m-d H:i:s");
		if ($today <= $task['date'])
			$deadline_ok = true;
		$student_work_href = ROOT.'/task/'.$student_work;*/
		$table = CoursesModel::get_all_marks_on_course($task_id);
    	require_once(ROOT. '/views/CurrentTaskTeacherView.php');


    }

	/*public static function actionView()
	{
		$user_type = $_SESSION['user_log_in'];
		$user_id = $_SESSION['user_id'];

		$user_courses = array();

		if ($user_type==2)
		{
			if($_POST)
			{
				extract($_POST);
				$create_course = CoursesModel::create_course($user_id, $course_name);
			}
			$user_courses = CoursesModel::get_teacher_courses($user_id);
			require_once(ROOT.'/views/CoursesTeacherView.php');

		}
	}

	public static function actionCurrentCourse($id)
	{
		$course_id = $id;
		$user_type = $_SESSION['user_log_in'];
		$user_id = $_SESSION['user_id'];

		if ($user_type==2)
		{
			require_once(ROOT.'/views/CurrentCourseTeacherView.php');
		}
		//echo $id;
	}
	*/
	
}



?>