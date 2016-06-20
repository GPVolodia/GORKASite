<?php

class CoursesModel
{
    public static function get_teacher_courses($user_id)
    {
        $courses = array();
        $bd = DB::connect();
        $query_get_courses = mysql_query("SELECT courses.id as 'cours_id', users.id as 'teacher_id',
            courses.name as 'cours_name', users.name as 'user_name', surname FROM courses
            LEFT JOIN users ON courses.teacher = users.id WHERE teacher='$user_id'");
        $num_rows = mysql_num_rows($query_get_courses);
        if ($num_rows >= 1)
        {
            $i = 0;
            while($row = mysql_fetch_array($query_get_courses))
            {
                $courses[$i]['course_id'] = $row['cours_id'];
                $courses[$i]['teacher_id'] = $row['teacher_id'];
                $courses[$i]['course_name'] = $row['cours_name'];
                $courses[$i]['teacher_name'] = $row['user_name'];
                $courses[$i]['teacher_surname'] = $row['surname'];
                $i++;
            }
            return $courses;
        }
        else 
            return "Ви не створили жодного курсу.";
    }

    public static function create_course($teacher, $course_name)
    {
        $bd = DB::connect();
        $insert_course = mysql_query("INSERT INTO courses(name, teacher) VALUES ('$course_name', '$teacher')");
    }

    public static function get_course_name($id)
    {
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM courses WHERE id='$id'");
        $row = mysql_fetch_array($query);
        return $row['name'];
    }

    /*public static function add_message($_POST, $user)
    {

        $bd = DB::connect();
        extract($_POST);
        $ip = $_SERVER['REMOTE_ADDR'];
        $today = date("Y-m-d H:i:s");
        if ($user['name'])
        {
            $username = $user['name'];
            $query = mysql_query("INSERT INTO messages(name, message, date, ip) 
                VALUES ('$username', '$message', '$today', '$ip')");
        }
        else
        {
            $query = mysql_query("INSERT INTO messages(name, message, date, ip) 
                VALUES ('$name', '$message', '$today', '$ip')");
        }
    }*/

    /*public static function get_user_message($id)
    {
        $bd = DB::connect();
        $mess = array();
        $id=$id-1;
        $mess_count = 2;
        $query = mysql_query("SELECT * FROM messages");
        $num_row = mysql_num_rows($query);
        $page_count = (int)ceil( $num_row / $mess_count );
        $query = mysql_query("SELECT * FROM messages LIMIT ".($mess_count*$id).", ".$mess_count);
        while ($row=mysql_fetch_array($query)) 
        {
            $mess[$i]['id'] = $row['id'];
            $mess[$i]['name'] = $row['name'];
            $mess[$i]['message'] = $row['message'];
            $mess[$i]['date'] = $row['date'];
            $mess[$i]['ip'] = $row['ip'];
            $i++;   
        }
        return $mess;
        
    }

    public static function get_page_count()
    {
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM messages");
        $mess_count = 2;
        $num_row = mysql_num_rows($query);
        $page_count = (int)ceil( $num_row / $mess_count );
        return $page_count;
    }

    public static function get_message($_POST, $user)
    {
        extract($_POST);
        if ($submit)
        {
            if ($name)
                $message = "Дякуюємо ,$name, за Ваше повідомлення!";
            else 
            {
                $my_name = $user['name'];
                $message = "Дякуюємо , $my_name , за Ваше повідомлення!";
            }
            $function = self::add_message($_POST, $user);
        }
        return $message;
    }


*/
    /*public static function check_message($message)
    {

        if(strlen($message <= '6'))
            return "Поле Повідомлення має містити більше 6 символів!";
    }*/

}
?>