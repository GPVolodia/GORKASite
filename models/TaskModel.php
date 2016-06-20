<?php

class TaskModel
{
    public static function add_task($_POST, $course_id)
    {
        $my_date = $_POST['date'];
        $my_description = $_POST['description'];
        $my_name = $_POST['name'];
        $my_id_course = $course_id;
        $my_max_marc = $_POST['max_marc'];
        $my_type = $_POST['type'];
        $bd = DB::connect();
        $filename = $_FILES['filename']['name'];
        $query_add_task = mysql_query("INSERT INTO task(date, description, name, 
            id_course, max_marc, file, type) VALUES ('$my_date', '$my_description', '$my_name',
            '$my_id_course', '$my_max_marc', '$filename', '$my_type')");
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
        $create_dir = self::create_dir_task($my_name, $my_description, $my_max_marc);
        $url = "/courses/".$course_id.'/';
        header('Location: $url');
    }

    public static function edit_task($_POST, $task_id)
    {
        $my_date = $_POST['date'];
        $my_description = $_POST['description'];
        $my_name = $_POST['name'];
        $my_id_course = $course_id;
        $my_max_marc = $_POST['max_marc'];
        $my_type = $_POST['type'];

        $bd = DB::connect();
        $filename = $_FILES['filename']['name'];
        if ($my_name)  $query = mysql_query("UPDATE task SET name = '$my_name' WHERE id='$task_id'");
        if ($my_max_marc)  $query = mysql_query("UPDATE task SET max_marc = '$my_max_marc' WHERE id='$task_id'");
        if ($my_description)  $query = mysql_query("UPDATE task SET description = '$my_description' WHERE id='$task_id'");
        if ($my_max_marc)  $query = mysql_query("UPDATE task SET max_marc = '$my_max_marc' WHERE id='$task_id'");
        if ($my_date)  $query = mysql_query("UPDATE task SET date = '$my_date' WHERE id='$task_id'");
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
        $create_dir = self::create_dir_task($my_name, $my_description, $my_max_marc);
        
        header('Location: /courses');
    }

    public static function create_dir_task($my_name, $my_description, $my_max_marc)
    {
        $bd = DB::connect();
        $name = $my_name;
        $description = $my_description;
        $mark = $my_max_marc;
        $query = mysql_query("SELECT * FROM task WHERE name='$name' AND description='$my_description' AND
            max_marc='$mark'");
        $row = mysql_fetch_array($query);
        $task_id = $row['id'];
        $dir = ROOT.'/works/'.$task_id;
        mkdir($dir, 0700);
    }



    public static function get_course_task_mark($course_id, $user_id)
    {
        $bd=DB::connect();
        $c_id = $course_id;
        $u_id = $user_id;
        $list_marks = array();
        $query = mysql_query("SELECT * FROM task
            LEFT JOIN users_course ON users_course.id_course = task.id_course
            LEFT JOIN journal ON journal.id_user = users_course.id_user AND journal.id_task = task.id
            WHERE users_course.id_user='$u_id' AND users_course.id_course='$c_id'");
        while ($row = mysql_fetch_array($query))
        {
            $list_marks[] = $row;
        }
        return $list_marks;
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
    }

    public static function get_current_task($arg_task_id)
    {
        $task_id = $arg_task_id;
        $bd = DB::connect();
        $query_get_task = mysql_query("SELECT * FROM task WHERE id='$task_id'");
        $row = mysql_fetch_array($query_get_task);
        return $row;
    }

    public static function check_plagiarism($arg_task_id, $arg_work)
    {
        $bd = DB::connect();
        $task_id = $arg_task_id;
        $query_get_task_type = mysql_query("SELECT type FROM task WHERE id='$arg_task_id'");
        $row = mysql_fetch_array($query_get_task_type);
        
        if ($row['type'] == 0)
        {
                $work = $arg_work;
                $list_works = array();
                //Отримуємо всі роботи крім поточної
                $query = mysql_query("SELECT * FROM work WHERE id_task='$task_id'");
                while ($row=mysql_fetch_array($query))
                {
                    if ($row['work'] != $work)
                        $list_works[] = $row['work'];
                }
                //Визначення оцінки в порівнянні з кожним файлом
                $plagiarism_coef = array();

                $shingler = new ShinglesMethod(1);


                $filename_main = ROOT.'/works/'.$task_id.'/'.$work.'';
                $content = WordModel::read_file_docx($filename_main);
                if($content !== false) {  $textA = nl2br($content);   }
                //echo $textA;

                foreach($list_works as $cur_work)
                {
                    //echo "<br>=====================================<br>";   
                    $filename = ROOT.'/works/'.$task_id.'/'.$cur_work.'';
                    $content = WordModel::read_file_docx($filename);
                    if($content !== false) {  $textB = nl2br($content);  }
                    
                    //echo $textB;
                    $first_coef = $shingler->compare($textA, $textB);
                    //var_dump($first_coef);
                    //$second_coef = $shingler->compare($textB, $textA);
                    //var_dump($second_coef);
                    if ($first_coef <= 100)
                        $plagiarism_coef[] = $first_coef;
                    else
                    {
                        $second_coef = $shingler->compare($textB, $textA);
                        var_dump($second_coef);
                        if ($second_coef >= 150)
                            $cur_coef = ($first_coef - $second_coef)/2;
                        else 
                            $cur_coef = ($first_coef - $second_coef)/5;
                        var_dump($cur_coef);
                        $result_coef = $second_coef - $cur_coef;
                        $plagiarism_coef[] = $result_coef;
                    }
                    //if ($second_coef <= 100)
                      //  $plagiarism_coef[] = $second_coef;
                }

                //var_dump($plagiarism_coef);
                $query_get_work = mysql_query("SELECT * FROM work WHERE work='$work'");
                $row= mysql_fetch_array($query_get_work);
                $work_id = $row['id'];
                //var_dump($plagiarism_coef);


                $max_coef = max($plagiarism_coef);
                $query = mysql_query("SELECT * FROM plagiarism WHERE id_task='$task_id' AND id_work='$work_id'");
                $number_rows = mysql_num_rows($query);
                if ($number_rows >=1)
                    $query = mysql_query("UPDATE plagiarism SET coef='$max_coef' WHERE id_task='$task_id' AND id_work='$work_id'");
                else
                    $query = mysql_query("INSERT INTO plagiarism(id_task, id_work, coef)
                        VALUES('$task_id','$work_id','$max_coef')");
                return max($plagiarism_coef);
        }
        else
        {
            $work = $arg_work;
            $list_works = array();
            //Отримуємо всі роботи крім поточної
            $query = mysql_query("SELECT * FROM work WHERE id_task='$task_id'");
            while ($row=mysql_fetch_array($query))
            {
                if ($row['work'] != $work)
                    $list_works[] = $row['work'];
            }
            //Визначення оцінки в порівнянні з кожним файлом
            $plagiarism_coef = array();

            $shingler = new AlgorythmMethod(1);

            $stopWords = array('for', 'int', 'if', 'float', 'echo', 'foreach', 'do',
            'while', 'array', 'break', 'continue', 'function', 'var', '<?php', '?>', 'class');

            $filename_main = ROOT.'/works/'.$task_id.'/'.$work.'';
            $content = WordModel::read_file_docx($filename_main);
            if($content !== false) {  $textA = nl2br($content);   }

            $text_arr = explode("\n", $textA);
            for ($i=0; $i<count($text_arr); $i++)
            {
                foreach($stopWords as $word)
                {
                    if (stripos($text_arr[$i], $word))
                        unset($text_arr[$i]);
                }
            }
           // var_dump($text_arr);
            $textA = implode("", $text_arr);
            //var_dump($textA);
            //var_dump($textA);
            foreach($list_works as $cur_work)
            {
                //echo "<br>=====================================<br>";   
                $filename = ROOT.'/works/'.$task_id.'/'.$cur_work.'';
                $content = WordModel::read_file_docx($filename);
                if($content !== false) {  $textB = nl2br($content);  }
               
                $text_arr_b = explode("\n", $textB);

                for ($i=0; $i<count($text_arr_b); $i++)
                {
                    foreach($stopWords as $word)
                    {
                        if (stripos($text_arr_b[$i], $word))
                            unset($text_arr_b[$i]);
                    }
                }
                //var_dump($text_arr_b);
                $textB = implode("", $text_arr_b);
                //var_dump($textB);
                //var_dump($textA);

                //echo $textB;
                $first_coef = $shingler->compare($textA, $textB);
               // var_dump($textA);
                //var_dump($textB);
                //var_dump($first_coef);
                //$second_coef = $shingler->compare($textB, $textA);
                //var_dump($second_coef);
                if ($first_coef <= 100)
                    $plagiarism_coef[] = $first_coef;
                else
                {
                    $second_coef = $shingler->compare($textB, $textA);
                    var_dump($second_coef);
                    if ($second_coef >= 150)
                        $cur_coef = ($first_coef - $second_coef)/2;
                    else 
                        $cur_coef = ($first_coef - $second_coef)/5;
                    var_dump($cur_coef);
                    $result_coef = $second_coef - $cur_coef;
                    $plagiarism_coef[] = $result_coef;
                }
                //if ($second_coef <= 100)
                  //  $plagiarism_coef[] = $second_coef;
            }

            //var_dump($plagiarism_coef);
            $query_get_work = mysql_query("SELECT * FROM work WHERE work='$work'");
            $row= mysql_fetch_array($query_get_work);
            $work_id = $row['id'];
            //var_dump($plagiarism_coef);


            $max_coef = max($plagiarism_coef);
            $query = mysql_query("SELECT * FROM plagiarism WHERE id_task='$task_id' AND id_work='$work_id'");
            $number_rows = mysql_num_rows($query);
            if ($number_rows >=1)
                $query = mysql_query("UPDATE plagiarism SET coef='$max_coef' WHERE id_task='$task_id' AND id_work='$work_id'");
            else
                $query = mysql_query("INSERT INTO plagiarism(id_task, id_work, coef)
                    VALUES('$task_id','$work_id','$max_coef')");
            return max($plagiarism_coef);
        }

        //var_dump($plagiarism_coef);

        //

    }

}
?>