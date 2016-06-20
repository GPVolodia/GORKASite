<?php 
class FriendsController 
{
	public static function actionView()
	{
		require_once(ROOT.'/views/FriendsView.php');
	}

	public static function actionPeople()
	{
		//var_dump($_POST);
		$people_arr = FriendsModel::get_people();
		$friend_arr = FriendsModel::get_people_friends();
		//var_dump($friend_arr);
		require_once(ROOT.'/views/PeopleView.php');
	}







}

?>