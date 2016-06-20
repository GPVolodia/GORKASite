<?php 

class UserController
{
	public static function actionLogout()
	{
		session_unset();
		session_destroy();
		echo '<script type="text/javascript">
           				window.location = "/news"
        			</script>';

	}

	public static function actionRight()
	{
		$users_for_teacher = array();
		$users_for_teacher = UserModel::get_users_for_teacher();

		//var_dump($users_for_teacher);
		$teacher_users = array();
		$teacher_users = UserModel::get_current_teacher();

		
		if ($_POST['add_teacher'])
		{
			$create = UserModel::add_teacher($_POST);
			
			header("Location: http://localhost/user_rights");
		}
		if ($_POST['delete_teacher'])
		{
			$add = UserModel::delete_teacher($_POST);
			header("Location: http://localhost/user_rights");
		}
		require_once(ROOT.'/views/RightsView.php');
	}

	public static function actionEditProfile()
	{
		extract($_POST);
		if ($_POST)
			$error_list = UserModel::edit_profile($user_name, $surname, $mail, $login, $filename);
		$information=UserModel::get_user_inform();
		require_once(ROOT.'/views/EditProfileView.php');
	}

	public static function actionProfile()
	{
		$information=UserModel::get_user_inform();
		$user_role=UserModel::get_user_role();
		require_once(ROOT.'/views/ProfileView.php');
	}

	public static function actionLogin()
	{
		extract($_POST);
		if ($_POST)
			$message = UserModel::login($login,  $l_password);
		require_once(ROOT. '/views/LoginView.php');
	}

	public function actionRegistration()
	{
		extract($_POST);
		$message = array();
		$message = UserModel::registration($user_name, $surname, $mail, $login,  $l_password, $r_password, $group);
		require_once(ROOT. '/views/RegistrationView.php');
	}
}



?>