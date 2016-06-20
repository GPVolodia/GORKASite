<?php 

class JournalController
{
	public static function actionTeacherView($course_id)
    {
    	$course_name = CoursesModel::get_course_name($course_id);
    	$groups = UserModel::get_all_groups();
    	//$tasks_list = CoursesModel::get_all_tasks($course_id);
    	$number_of_tasks = count($tasks_list);
    	//$student_mark_list = CoursesModel::get_students_marks_on_course($course_id);
    	$stud_groups = JournalModel::get_group_mark($course_id);
    	$students = count($stud_groups);
    	//$ololo = JournalModel::get_group_mark("IS-31");
        /*if ($_POST)
        	if ($_POST['name'])
        		$add_task = TaskModel::add_task($_POST, $course_id);  */
		require_once(ROOT. '/views/TeacherJournalView.php');
    }

    public static function actionStudentView($course_id)
    {
    	$course_name = CoursesModel::get_course_name($course_id);
    	$user_id = $_SESSION['user_id'];
    	$list_marks = TaskModel::get_course_task_mark($course_id, $user_id);
    	
    	require_once(ROOT. '/views/StudentJournalView.php');
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