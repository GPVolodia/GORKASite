<?php 

class CoursesController
{
	public static function actionView()
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
		if ($user_type==1)
		{
			$user_courses = CoursesModel::get_student_courses($user_id);
			require_once(ROOT.'/views/CoursesStudentView.php');
		}
	}

	public static function actionDeleteCourse($id)
	{
		$delete_course = CoursesModel::delete_course($id);
		header('Location: /courses');
	}

	public static function actionCurrentCourse($id)
	{
		$course_id = $id;
		$user_type = $_SESSION['user_log_in'];
		$user_id = $_SESSION['user_id'];

		if ($user_type==2)
		{
			$group = "IS-31";
			$course_name = CoursesModel::get_course_name($id);
			$tasks = TaskModel::get_course_tasks($id);
			$groups = UserModel::get_all_groups();
			$students = UserModel::get_all_students($group);
			if ($_POST['group_submit'])
				$add_group = CoursesModel::add_group_on_course($_POST, $course_id);
			if ($_POST['student_submit'])
				$add_student = CoursesModel::add_student_on_course($_POST, $course_id);
			//var_dump($groups);
			//var_dump($tasks);
			require_once(ROOT.'/views/CurrentCourseTeacherView.php');
		}
		if ($user_type==1)
		{
			$course_name = CoursesModel::get_course_name($id);
			$tasks = TaskModel::get_course_tasks($id);
			require_once(ROOT.'/views/CurrentCourseStudentView.php');
		}
		if ($user_type==100)
		{
			$course_name = CoursesModel::get_course_name($id);
			$tasks = TaskModel::get_course_tasks($id);
			require_once(ROOT.'/views/CurrentCourseStudentView.php');
		}
		//echo $id;
	}

	
}



?>