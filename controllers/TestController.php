<?php

class TestController
{
    public static function actionView()
    {
    	if ($_POST)
  			$add_message = TestModel::add_message($_POST);
    	$messages = TestModel::get_all_messages();
        require_once(ROOT . '/views/MainView.php');
    }

    public static function actionAdminView()
    {
    	if ($_POST)
    		$validation = true;
    	$messages = TestModel::get_all_messages();
    	require_once(ROOT . '/views/AdminView.php');	
    	
    }

	public static function actionTimerView()
    {
    	require_once(ROOT . '/views/TimerView.php');	
    }

    public static function actionDeleteMessage($id)
    {
    	$message_delete = TestModel::delete_message($id);
    	header('Location: /admin');
    }

    

    
}
?>