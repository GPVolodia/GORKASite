<?php 

class WorkController
{
	public static function actionAddTask($course_id)
    {
        if ($_POST)
        	if ($_POST['name'])
        		$add_task = TaskModel::add_task($_POST, $course_id);  
		require_once(ROOT. '/views/AddTaskView.php');
    }

    public static function actionCurrentTask($course_id, $task_id)
    {
    	$task = TaskModel::get_current_task($task_id);
    	require_once(ROOT. '/views/CurrentTaskStudentView.php');


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