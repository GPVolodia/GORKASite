<?php 
class FriendsModel
{
	public static function get_people()
	{
		$bd = DB::connect();
		$people_arr = array();
		$user_id = $_SESSION['user_id'];
		//echo $user_id;
		$query_get_people = mysql_query("SELECT * FROM users WHERE NOT id='$user_id'");
		$i = 0;
		while ($row = mysql_fetch_array($query_get_people))
		{
			$people_arr[$i]['id'] = $row['id'];
			$people_arr[$i]['login'] = $row['login'];
			$people_arr[$i]['mail'] = $row['mail'];
			$people_arr[$i]['name'] = $row['name'];
			$people_arr[$i]['surname'] = $row['surname'];
			$people_arr[$i]['avatar'] = $row['avatar'];
			$i++;

		}
		return $people_arr;
	}

	public function get_people_friends()
	{
		$bd = DB::connect();
		$friend_arr_new = array();
		$user_id = $_SESSION['user_id'];
		$query_get_friend_list = mysql_query("SELECT * FROM friends WHERE id_user='$user_id'");
		while ($row = mysql_fetch_array($query_get_friend_list))
		{
			array_push($friend_arr_new, $row['id_friend']);
		}
		return $friend_arr_new;
	}


}

?>