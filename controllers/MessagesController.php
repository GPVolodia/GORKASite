<?php 

class MessagesController
{
	public static function actionWrite()
	{
		extract($_POST);
		$user = UserModel::get_user_inform();
		$messages = array();
		$messages = MessagesModel::get_message($_POST, $user);

		require_once(ROOT. '/views/FeedbackView.php');
	}

	public static function actionView($id)
	{

		$messages = MessagesModel::get_user_message($id);
		$page_count = MessagesModel::get_page_count();
		$current_page = $id;
		require_once(ROOT. '/views/AnswersView.php');
	}

}



?>