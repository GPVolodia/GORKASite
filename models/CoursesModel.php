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

    public static function delete_course($id)
    {
        $bd = DB::connect();
        $cur_course_id = $id;
        //echo $cur_course_id;
        $query = mysql_query("DELETE FROM courses WHERE id='$cur_course_id'");
        $query = mysql_query("DELETE * FROM courses WHERE id='$cur_course_id'");
    }

    public static function get_student_courses($user_id)
    {
        $courses = array();
        $bd = DB::connect();
        $query_get_courses = mysql_query("SELECT courses.name as 'cours_name', courses.id as 'cours_id',
            users.name as 'user_name', users.surname as 'surname' FROM users_course
            LEFT JOIN users ON users_course.id_user = users.id
            LEFT JOIN courses ON courses.id = users_course.id_course
            WHERE id_user = '$user_id'");
        $num_rows = mysql_num_rows($query_get_courses);
        if ($num_rows >= 1)
        {
            $i = 0;
            while($row = mysql_fetch_array($query_get_courses))
            {
                $courses[$i]['course_id'] = $row['cours_id'];
                $temp = $courses[$i]['course_id'];
                $query_get_teacher = mysql_query("SELECT users.name as 'user_name', users.surname as 'surname' FROM users
                    LEFT JOIN courses ON users.id = courses.teacher WHERE courses.id='$temp'");
                $row_ololo = mysql_fetch_array($query_get_teacher);
                $courses[$i]['teacher_id'] = $row['teacher_id'];
                $courses[$i]['course_name'] = $row['cours_name'];
                $courses[$i]['teacher_name'] = $row_ololo['user_name'];
                $courses[$i]['teacher_surname'] = $row_ololo['surname'];
                $i++;
            }
            return $courses;
        }
        else 
            return "Ви не є учасником жодного курсу.";
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

    public static function add_group_on_course($_POST, $course_id)
    {
        $bd = DB::connect();
        $my_course = $course_id;
        extract($_POST);
        $add_group = $group;
        if ($add_group)
        {
            $query_students_list = mysql_query("SELECT users.id FROM users
                WHERE stud_group='$add_group'");
            $stud_list = array();
            $i=0;
            while ($row=mysql_fetch_array($query_students_list))
            {
                $stud_list[$i] = $row['id'];
                $i++;
            }
            $stud_list_coma = join(",", $stud_list);
            $query_delete = mysql_query("DELETE FROM users_course 
                WHERE id_user IN ($stud_list_coma) AND id_course='$my_course'");
            foreach($stud_list as $el)
            {
                $query_insert = mysql_query("INSERT INTO users_course(id_user, id_course, stud_group)
                VALUES('$el', '$my_course', '$add_group')");
            }
            $operation = true;
            return $operation;
        }
        $operation = false;
        return $operation;
    }

    public static function add_student_on_course($_POST, $course_id)
    {
        $bd = DB::connect();
        $my_course = $course_id;
        extract($_POST);
        $add_student = $student_id;
        $query_student = mysql_query("SELECT * FROM users WHERE id='$add_student'");
        $row = mysql_fetch_array($query_student);
        $current_group = $row['stud_group'];
        if ($add_student)
        {
            $query_delete = mysql_query("DELETE FROM users_course 
                WHERE id_user='$add_student' AND id_course='$my_course'");
            $query_insert = mysql_query("INSERT INTO users_course(id_user, id_course, stud_group)
                VALUES('$add_student', '$my_course', '$current_group')");
            $operation = true;
            return $operation;
        }
        $operation = false;
        return $operation;
    }

    public static function get_all_marks_on_course($arg_task_id)
    {
        $list = array();
        $task_id = $arg_task_id;        
        /*$query = mysql_query("SELECT users.name, users.surname, journal.mark FROM users
            LEFT JOIN users_course ON users.id = users_course.id_user
            LEFT JOIN task ON task.id_course = users_course.id_course
            LEFT JOIN journal ON journal journal.id_task=task.id_task
            WHERE journal.id_task = '$task_id' AND journal.group = '$group' ");*/
        /*$query = mysql_query("SELECT * FROM journal
            RIGHT JOIN users ON users.id_user = journal.id_user
            LEFT JOIN task ON journal.id_task =  task.id
            WHERE task.id='$task_id'");*/
        /*$query = mysql_query("SELECT users.id, users.stud_group, users.name, users.surname, work.work, journal.mark FROM users_course
            LEFT JOIN users ON users.id = users_course.id_user
            LEFT JOIN task ON task.id_course = users_course.id_course
            LEFT JOIN journal ON journal.id_task = task.id AND journal.id_user = users.id
            LEFT JOIN work ON work.id_user = users.id AND work.id_task = task.id
            WHERE task.id='$task_id'
            ORDER BY users.stud_group, users.name");*/
        $query = mysql_query("SELECT plagiarism.coef, users.id, users.stud_group, users.name, users.surname, work.work, journal.mark FROM users_course
            LEFT JOIN users ON users.id = users_course.id_user
            LEFT JOIN task ON task.id_course = users_course.id_course
            LEFT JOIN journal ON journal.id_task = task.id AND journal.id_user = users.id
            LEFT JOIN work ON work.id_user = users.id AND work.id_task = task.id
            LEFT JOIN plagiarism ON plagiarism.id_task = task.id AND plagiarism.id_work=work.id
            WHERE task.id='$task_id'
            ORDER BY users.stud_group, users.name");
        while ($row = mysql_fetch_array($query))
        {
            $list[] = $row;
        }
        return $list;
    }

    public static function get_students_marks_on_course($arg_course_id)
    {
        $bd = DB::connect();
        $task_marks = array();
        $course_id = $arg_course_id;
        $query = mysql_query("SELECT users.name as 'user_name', users.surname as 'user_surname', users.stud_group, task.name, task.id,
        journal.mark FROM users_course
                LEFT JOIN journal ON users_course.id_user = journal.id_user
                LEFT JOIN users ON users_course.id_user = users.id
                LEFT JOIN task ON task.id = journal.id_task
                WHERE users_course.id_course='$course_id'
                ORDER BY users.stud_group, users.name, task.id ");
        $i = 0;
        while($row=mysql_fetch_array($query))
        {
         
            $task_marks[] = $row;
        }
        $counter = 1;
        $fucking = array();
        for($i=0;$i<count($task_marks); $i++)
        {
            if ($task_marks[$i]['user_name'] == $task_marks[$i+1]['user_name'])
            {
                $counter++;
            }
            else
            {
                //$fucking.push($counter);
                array_push($fucking, $counter);
                $counter = 0;
            }
        }
        var_dump($fucking);
        return $task_marks;       
    }

    public static function get_all_tasks($arg_course_id)
    {
        $course_id = $arg_course_id;
        $bd = DB::connect();
        $tasks = array();
        $query_get_task = mysql_query("SELECT * FROM task WHERE id_course='$course_id' ORDER BY task.id");
        while($row = mysql_fetch_array($query_get_task))
        {
            $tasks[] = $row;
        }
        return $tasks;
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