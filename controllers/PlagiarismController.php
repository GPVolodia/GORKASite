<?php 

class PlagiarismController
{
	public static function actionView()
    {
    	$user_id = $_SESSION['user_id'];
    	if ($_POST)
    	{
    		var_dump($_POST);
    	}

    	$courses = CoursesModel::get_teacher_courses($user_id);
    	//var_dump($courses);
		require_once(ROOT. '/views/PlagiarismView.php');
    }
}



?>