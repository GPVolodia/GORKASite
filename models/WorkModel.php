<?php

class WorkModel
{
    public static function get_student_work($task_id, $user_id)
    {
        $bd = DB::conncet();
        $t_id = $task_id;
        $u_id = $user_id;
        $query = mysql_query("SELECT * FROM task WHERE id_task='$t_id' AND id_user='$'");

    }

    public static function submit_work($_FILES, $_POST, $task_id, $user_id)
    {
        $t_id = $task_id;
        $u_id = $user_id;
        extract($_POST);
        
        if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
        {

            $fule_name = $_FILES['filename']['name'];
            $filename_input = $fule_name;
            $filename = iconv('utf-8','windows-1251',$filename_input);
            $dir = ROOT.'/works/'.$task_id.'/';
            move_uploaded_file($_FILES["filename"]["tmp_name"], $dir.$filename);
        }
        $today = date("Y-m-d H:i:s");
        $bd = DB::connect();
        $query = mysql_query("INSERT INTO work(id_task, id_user, work, date) 
            VALUES('$t_id' , '$u_id', '$filename_input', '$today') ");

    }

    public static function get_task_work($arg_task_id, $arg_user_id)
    {
        $t_id = $arg_task_id;
        $u_id = $arg_user_id;
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM work WHERE id_task='$t_id' AND id_user='$u_id'");
        $row = mysql_fetch_array($query);
        if ($row['work'])
            return $row['work'];
    }
}
?>