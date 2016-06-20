<?php

class JournalModel
{
    public static function get_group_mark($my_course_id)
    {
        //$my_group = $group;
        $mymy_course_id = $my_course_id;
        $query_get = mysql_query(" SELECT users.name, users.surname, users.stud_group,
                     task.name as 'task_name', journal.mark, task.id FROM users 
            LEFT JOIN users_course ON users.id = users_course.id_user
            LEFT JOIN courses ON courses.id = users_course.id_course
            LEFT JOIN task ON task.id_course = courses.id
            LEFT JOIN journal ON journal.id_user = users.id and journal.id_task = task.id
            WHERE courses.id='$mymy_course_id'");
        $query_get_people_in_group = mysql_query("SELECT * FROM users_course WHERE id_course='$mymy_course_id'");
        $num_stud = mysql_num_rows($query_get_people_in_group);
        $num_studa = mysql_num_rows($query_get);
        $number_same = $num_studa/$num_stud;
        $stud_group = array();
        $i=0; $j=0;
        while($row=mysql_fetch_array($query_get))
        {
            if ($j == $number_same)
            {
                $i++; $j=0;
            }
            $stud_group[$i]['name'] = $row['name'];
            $stud_group[$i]['surname'] = $row['surname'];
            $stud_group[$i]['stud_group'] = $row['stud_group'];
            $stud_group[$i]['tasks'][$j] = $row['task_name'];
            $stud_group[$i]['mark'][$j] = $row['mark'];
            $j++;
        }
        //echo '<pre>';
        //var_dump($stud_group);
        //echo '</pre>';
        return $stud_group;
    } 

    public static function get_task_student_mark($arg_task_id, $arg_user_id)
    {
        $t_id = $arg_task_id;
        $u_id = $arg_user_id;
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM journal WHERE id_task='$t_id' AND id_user='$u_id'");
        $row = mysql_fetch_array($query);
        if ($row['mark'])
            return $row['mark'];
        else return 0;
    }

    public static function put_mark($_POST, $task_id)    
    {
        $t_id = $task_id;
        $u_id = $_POST['user_id'];
        $mark = $_POST['mark'];
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM journal WHERE id_task='$t_id' AND id_user='$u_id'");
        $number = mysql_num_rows($query);
        if ($number>=1)
        {
            $query_update = mysql_query("UPDATE journal SET mark='$mark' WHERE id_task='$t_id' AND id_user='$u_id'");
        }
        else
        {
            $query_insert = mysql_query("INSERT INTO journal(id_task, id_user, mark)
                VALUES('$t_id','$u_id','$mark')");
        }
    }

    /*public static function add_task($_POST, $course_id)
    {
        $my_date = $_POST['date'];
        $my_description = $_POST['description'];
        $my_name = $_POST['name'];
        $my_id_course = $course_id;
        $my_max_marc = $_POST['max_marc'];
        $bd = DB::connect();
        $filename = $_FILES['filename']['name'];
        $query_add_task = mysql_query("INSERT INTO task(date, description, name, 
            id_course, max_marc, file) VALUES ('$my_date', '$my_description', '$my_name',
            '$my_id_course', '$my_max_marc', '$filename')");
        if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
        {
            $fule_name = $_FILES['filename']['name'];
            $part_name = explode(".", $fule_name);
            $expansion = $part_name[1];
            $filename = $fule_name;
            $pic_adress = $filename;
            $_FILES['userfile']['tmp_name'] = $row['id'];
            move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/files/tasks/".$filename);
        }
        $url = "/courses/".$course_id.'/';
        header('Location: $url');
    }
    public static function get_course_tasks($course_id)
    {
        $tasks = array();
        $bd = DB::connect();
        $query_get_task = mysql_query("SELECT * FROM task WHERE id_course='$course_id'");
        $num_rows = mysql_num_rows($query_get_task);
        if ($num_rows >= 1)
        {
            $i = 0;
            while($row = mysql_fetch_array($query_get_task))
            {
                $tasks[$i]['id'] = $row['id'];
                $tasks[$i]['date'] = $row['date'];
                $tasks[$i]['description'] = $row['description'];
                $tasks[$i]['name'] = $row['name'];
                $tasks[$i]['id_course'] = $row['id_course'];
                $tasks[$i]['max_marc'] = $row['max_marc'];
                $tasks[$i]['file'] = $row['file'];
                $i++;
            }
            return $tasks;
        }
        else 
            return "Наразі не створено жодного завдання на курсі.";
    }*/
}
?>