<?php 
class TestModel
{
	public static function add_message($_POST)
	{
		$bd = DB::connect();
		extract($_POST);
		$query = mysql_query("INSERT INTO messages(name, email, message)
			VALUES('$name', '$email', '$message')");
	}

	public static function get_all_messages()
	{
		$bd=DB::connect();
		$messages = array();
		$i = 0;
		$query = mysql_query("SELECT * FROM messages ORDER BY id desc");
		while($row=mysql_fetch_array($query))
		{
			$messages[$i]['id'] = $row['id'];
			$messages[$i]['name'] = $row['name'];
			$messages[$i]['email'] = $row['email'];
			$messages[$i]['message'] = $row['message'];
			$i++;
		}
		return $messages;
	}

	public static function delete_message($id)
	{
		$bd=DB::connect();
		$query = mysql_query("DELETE FROM messages WHERE id='$id'");
	}

	//public static function delete_message($id)
	/*{
		$bd=DB::connect();
		$query = mysql_query("DELETE FROM messages WHERE id='$id'");
	}*/
}


?>