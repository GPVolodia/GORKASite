<?php 

class NewsController
{
	public static function actionView()
	{

		$filename = ROOT.'/works/3/1.docx';// or /var/www/html/file.docx

		$content = WordModel::read_file_docx($filename);
		if($content !== false) {

		   // echo nl2br($content);
		    $textA = nl2br($content);
		}
		else {
		    	echo 'Couldn\'t the file. Please check that file.';
			}

		/*$textA = "Разум дан для того, чтобы он разумно жил, 
			а не для того только, чтобы fsdf sdf sdfs dfsd fsdf он понимал, что он неразумно gh живgfет.";
	    $textB = "Разум дан для того, чтобы он разумно жил, 
			а не для того только, чтобы fsdf sdf sdfs dfsd fsdf он понимал, что он неразумно gh живgfет.";*/
		$filename = ROOT.'/works/3/2.docx';// or /var/www/html/file.docx			
		$content = WordModel::read_file_docx($filename);
		if($content !== false) {

		    //echo nl2br($content);
		    $textB = nl2br($content);
		}
		else {
		    	echo 'Couldn\'t the file. Please check that file.';
			}
 		
    	
 
    	$shingler = new ShinglesMethod(1);
    	//echo $shingler->start_algorythm($textA, $textB);
    	//echo "Текст А похожий на В : "; echo $shingler->compare($textA, $textB); echo "<br>";
    	//echo "Текст В похожий на А : "; echo $shingler->compare($textB, $textA);
		$edit_news_rights = NewsModel::get_edit_rights();
		$news_list = array();
		$news_list = NewsModel::get_all_news();
		require_once(ROOT. '/views/NewsView.php');
	}

	public function actionEdit($id)
	{
		$id_news = $id;
		$current_new = NewsModel::get_current_new($id);

		$edit_news = NewsModel::edit_news($current_new, $_POST);
		require_once(ROOT. '/views/EditNewsView.php');
	}

	static public $news = array();

	public function actionWrite()
	{
		//echo 'de';
		if (!$_POST['preview'])
			$write_news = NewsModel::write_news($_POST, $_FILES);
		$filename = $_FILES['name'];
		//echo $filename;
		if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
	    {
	    	$fule_name = $_FILES['filename']['name'];
	    	$part_name = explode(".", $fule_name);
	    	$expansion = $part_name[1];
		    $filename = $fule_name;
		    $pic_adress = $filename;
		    $_FILES['userfile']['tmp_name'] = $row['id'];
	    	move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/documents/news/".$filename);
	    }
		if ($_POST['preview'] and !$_POST['bitch'])
		{
			self::$news = $_POST;
			$my_new = self::$news;
			$_SESSION['title'] = $_POST['title'];
			$_SESSION['content'] = $_POST['content'];
			$_SESSION['new_date_time'] = $_POST['new_date_time'];
			$_SESSION['video'] = $_POST['video'];
			$_SESSION['picture'] = $_FILES['filename']['name'];

		}
		if ($_POST['preview'] or $_POST['bitch'])
		{

			if ($_POST['bitch'])
			{
				
				$my_new['title'] = $_SESSION['title'];
				$my_new['content'] = $_SESSION['content']; 
				
				$my_new['new_date_time'] = $_SESSION['new_date_time'];
				$my_new['video'] = $_SESSION['video']; 
				$my_new['picture'] = $_SESSION['picture']; 
				
				$write_news = NewsModel::write_news($my_new, $_FILES);
				header('Location: /news');	


			}
			require_once(ROOT. '/views/PreNewsView.php');	
			
			
			
			//var_dump($_POST);
			
			//if ($_POST['submit'])
			//	require_once(ROOT. '/views/PreNewsVw.php');	
		}
		else
			require_once(ROOT. '/views/AddNewsView.php');
	}

	public function actionPreview_new($news)
	{
		
		
		
	}

	public function actionComments()
	{
		$comments = NewsModel::get_work_comments();




		require_once(ROOT.'/views/CommentsView.php');
	}

	public function actionDelete($id)
	{
		$id_news = $id;
		$delete_news = NewsModel::delete_news($id_news);

		require_once(ROOT.'/views/NewsView.php');
	}

	public function actionAdd_com_db($id)
	{
		$bd = DB::connect();
		$query = mysql_query("UPDATE news_comment SET publish=1 WHERE id='$id'");
		self::actionComments();
	}

	public function actionDelete_com($id)
	{
		$bd = DB::connect();
		$query = mysql_query("DELETE FROM news_comment WHERE id='$id'");
		self::actionComments();
	}

	public function actionCurrent_news($id)
	{
		$current_new = array();
		$current_new = NewsModel::get_current_new($id);
		$cur_new_name = NewsModel::get_name_new();
		$comments  = NewsModel::get_comments($id);
		if ($_POST['submit'])
		{
			NewsModel::add_comment($_POST, $id);
			//self::phpAlert("Коментар надіслано. Він буде опрацьованим.");
		}
		require_once(ROOT. '/views/CurrentNewsView.php');
	}

	function phpAlert($msg) 
	{
    	echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}

	public static function actionLogin()
	{
		echo "You are login<br>";
	}


}



?>