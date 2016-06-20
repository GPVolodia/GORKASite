<?php 
class NewsModel
{
	static public $my_new_name;
	public function get_all_news()
	{
		$bd = DB::connect();
		$today = date("Y-m-d H:i:s");
		$query_get_news = mysql_query("SELECT * FROM news WHERE datetime <= '$today' order by id desc");

		$news = array();
		$i = 0;
		while ($row=mysql_fetch_array($query_get_news)) 
		{
			$cur_id = $row['id'];
			$query_get_coments = mysql_query("SELECT * FROM news_comment WHERE id_new='$cur_id' and publish=1");
			$num_com = mysql_num_rows($query_get_coments);

			$news[$i]['id'] = $row['id'];
			$news[$i]['datetime'] = $row['datetime'];
			$news[$i]['name'] = $row['name'];
			$news[$i]['surname'] = $row['surname'];
			$news[$i]['content'] = $row['content'];
			$news[$i]['picture'] = $row['picture'];
			$news[$i]['video'] = $row['video'];
			$news[$i]['title'] = $row['title'];
			$news[$i]['num_com']  = $num_com;
			$i++;	
		}
		return $news;
	}

	public function write_news($var, $_FILES)
	{
		
		extract($var);
		$bd = DB::connect();
		$user_id = $_SESSION['user_id'];
		$query_get_user = mysql_query("SELECT name, surname FROM users WHERE id='$user_id'");
		$row = mysql_fetch_array($query_get_user);
		$name = $row['name'];
		$surname = $row['surname'];
		//var_dump($var);
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
	    if ($video)
      	{	
      	   
	        $user_watch = $_SESSION['user_id'];
	        $link = $_POST['video'];

	        list($some_adress, $video)=explode('v=', $link);
	        $const_adress = "http://www.youtube.com/embed/";
	        $insert_adress = $const_adress.$video;
	        $user_id = $_SESSION['user_id'];
	        $video_adress = $insert_adress;
     	}
     	if ($name and ($content or $title))
     	{
     		if ($var['picture'])
				$pic_adress = $var['picture'];
			
			$query_insert = mysql_query("INSERT INTO news(datetime, name, surname, content, picture, video, title) 
        		VALUES ('$new_date_time', '$name', '$surname', '$content', '$pic_adress', '$video_adress', '$title')");

		}
		if ($submit)
			NewsController::actionView();
	}

	public function delete_news($id)
	{
		
		$bd = DB::connect();
		$query = mysql_query("DELETE FROM news WHERE id='$id'");
		NewsController::actionView();
	}

	public function edit_news($current_new, $_POST)
	{

		$bd = DB::connect();
		$ne_id = $current_new[0]['id'];
		$new_news_title = $_POST['title'];
		$new_news_content = $_POST['content'];
		$new_news_name = $_POST['name'];
		$new_news_surname = $_POST['surname'];
		$new_news_video = $_POST['video'];
		$new_news_pics = $_FILES['name'];
		$new_date_time = $_POST['new_date_time'];
		if ($new_news_title)	$query = mysql_query("UPDATE news SET title = '$new_news_title' WHERE id='$ne_id'");
		if ($new_news_content)	$query = mysql_query("UPDATE news SET content = '$new_news_content' WHERE id='$ne_id'");
		if ($new_news_name)	$query = mysql_query("UPDATE news SET name = '$new_news_name' WHERE id='$ne_id'");
		if ($new_news_surname)	$query = mysql_query("UPDATE news SET surname = '$new_news_surname' WHERE id='$ne_id'");
		if ($new_date_time) $query = mysql_query("UPDATE news SET datetime = '$new_date_time' WHERE id='$ne_id'");
		if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
	    {

	    	$fule_name = $_FILES['filename']['name'];
	    	//echo $fule_name;
	    	$part_name = explode(".", $fule_name);
	    	$expansion = $part_name[1];
		    $filename = $fule_name;
		    $pic_adress = $filename;
		    $_FILES['userfile']['tmp_name'] = $row['id'];		 
	    	move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/documents/news/".$filename);
	    	//echo $ne_id;
	    	$query = mysql_query("UPDATE news SET picture = '$fule_name' WHERE id='$ne_id'");
	    } 
		$current_link = $current_new[0]['video'];
		$post_link = $_POST['video'];
		//echo $post_link;
		
		if (preg_match('~www.youtube.com/embed/~',$post_link))
		{$a = 10; }
		else 
		{
			
			$link = $_POST['video'];
			list($some_adress, $video)=explode('v=', $link);
			$const_adress = "https://www.youtube.com/embed/";
			$insert_adress = $const_adress.$video;
			//echo $insert_adress;
			//$query = mysql_query("UPDATE news SET video = '$insert_adress' WHERE id='$ne_id'");
		}
		if ($_POST['submit'])
			require_once(ROOT. '/views/SuccessOperationView.php');
	}

	public function get_work_comments()
	{
		$bd = DB::connect();
		$query = mysql_query("SELECT news_comment.id as 'id', id_new, comment, datetime, publish, name, surname
		 FROM news_comment LEFT JOIN users ON 
			news_comment.id_user=users.id WHERE publish = 0");
		$comments = array();
		$i = 0;
		while ($row=mysql_fetch_array($query)) 
		{

			$comments[$i]['id'] = $row['id'];
			$comments[$i]['id_new'] = $row['id_new'];
			$comments[$i]['comment'] = $row['comment'];
			$comments[$i]['datetime'] = $row['datetime'];
			$comments[$i]['publish'] = $row['publish'];
			$comments[$i]['name'] = $row['name'];
			$comments[$i]['surname'] = $row['surname'];
			$i++;	
		}
		return $comments;
	}

	public function get_edit_rights()
	{
		$bd = DB::connect();
		$user_id = $_SESSION['user_id'];

		$query = mysql_query("SELECT * FROM users LEFT JOIN users_role ON users.id = users_role.id_user
		LEFT JOIN role ON users_role.role = role.name WHERE users.id='$user_id' and id_right=2");
		
		$num_rows = mysql_num_rows($query);
		if ($num_rows >= 1)
			return true;
		else return false;
	}

	public function get_comments($id)
	{
		$bd = DB::connect();
		$comments = array();
		$query_comments = mysql_query("SELECT * FROM news_comment 
			LEFT JOIN users ON news_comment.id_user = users.id WHERE id_new = '$id' and publish=1");
		$i=0;
		while ($row=mysql_fetch_array($query_comments)) 
		{
			$comments[$i]['id'] = $row['id'];
			$comments[$i]['avatar'] = $row['avatar'];
			$comments[$i]['name'] = $row['name'];
			$comments[$i]['surname'] = $row['surname'];
			$comments[$i]['reply'] = $row['comment'];
			$comments[$i]['datetime'] = $row['datetime'];
			$i++;	
		}
		return $comments;
	}

	public function get_current_new($id)
	{
		$bd = DB::connect();
		$query_get_curr_new = mysql_query("SELECT * FROM news WHERE id=$id");
		$current_new = array();
		$row=mysql_fetch_array($query_get_curr_new);
		$i=0;
		$current_new[$i]['id'] = $row['id'];
		$current_new[$i]['datetime'] = $row['datetime'];
		$current_new[$i]['name'] = $row['name'];
		$current_new[$i]['surname'] = $row['surname'];
		$current_new[$i]['content'] = $row['content'];
		$current_new[$i]['picture'] = $row['picture'];
		$current_new[$i]['video'] = $row['video'];
		$current_new[$i]['title'] = $row['title'];
		$lol = self::set_new_name($row['title']);
		return $current_new;
	}

	public function set_new_name($name)
	{
		self::$my_new_name = $name;
	}

	public function get_name_new()
	{
		return self::$my_new_name;
	}

	public function add_comment($_POST, $id)
	{
		$bd = DB::connect();
		extract($_POST);
		$today = date("Y-m-d H:i:s");
		$user_id = $_SESSION['user_id'];
		$query = mysql_query("INSERT INTO news_comment(id_new, id_user, comment, datetime, publish) 
			VALUES ('$id', '$user_id', '$content', '$today', '0')");
	}
	

}


?>