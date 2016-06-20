<?php

class UserModel
{
    static public $registration_errors = array();
    static public $login_message = array();

    public static function registration($user_name, $surname, $mail, $login,  $l_password, $r_password,$group)
    {
        $check_nsl = self::check_nsl($user_name, $surname, $login, $group);
        self::$registration_errors = array_merge(self::$registration_errors, $check_nsl);
        $check_mail = self::check_mail($mail);
        array_push(self::$registration_errors, $check_mail);
        $check_name = self::check_password($l_password, $r_password);
        array_push(self::$registration_errors, $check_name);

        self::$registration_errors = array_diff(self::$registration_errors, array(NULL));

        if (count(self::$registration_errors) == 0)
        {
            self::register_user($user_name, $surname, $mail, $login,  $l_password, $r_password, $group);
            header('Location: /login');
        }
        return self::$registration_errors;
    }


    public static function edit_profile($user_name, $surname, $mail, $login, $filename)
    {

        $bd = DB::connect();
        $registration_errors = array();
        $user_id = $_SESSION['user_id'];
        $query_get_login = mysql_query("SELECT login FROM users WHERE id='$user_id'");
        $row = mysql_fetch_array($query_get_login);
        $cur_login = $row['login'];
        if ($cur_login == $login)
            $check_nsl = self::check_nsl_edit($user_name, $surname, "");
        else    
            $check_nsl = self::check_nsl_edit($user_name, $surname, $login);
        $registration_errors = array_merge($registration_errors, $check_nsl);  
        $check_mail = self::check_mail($mail);
        array_push($registration_errors, $check_mail);
        
        //var_dump($registration_errors);
        //echo "brfore if";
        //echo $user_name;
        //var_dump($registration_errors);
        if (count($registration_errors) == 0 || is_null($registration_errors) || $registration_errors[0] == null)
        {

            if ($user_name)  $query = mysql_query("UPDATE users SET name = '$user_name' WHERE id='$user_id'");
            if ($surname)   $query = mysql_query("UPDATE users SET surname = '$surname' WHERE id='$user_id'");
            if ($mail)  $query = mysql_query("UPDATE users SET mail = '$mail' WHERE id='$user_id'");
            if ($login) $query = mysql_query("UPDATE users SET login = '$login' WHERE id='$user_id'");

            if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
            {
                
                $query = mysql_query("UPDATE users SET avatar = '$user_id' WHERE id='$user_id'");
                $filename = $user_id.".jpg";
                $_FILES['userfile']['tmp_name'] = $row['id'];
                echo $_FILES['userfile']['name'];
                
                move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/images/avatar/".$filename);
            } 
        }
        else 
            return $registration_errors;
    }

    public static function get_roles()
    {
        $roles = array();
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM role GROUP BY name");
        $i = 0;
        while ($row = mysql_fetch_array($query))
        {
            $roles[$i] = $row['name'];
            $i++;
        }
        return $roles;
    }

    public function add_role($_POST)
    {
        extract($_POST);
        
        $bd = DB::connect();
        if ($user and $position)
        {
            $query = mysql_query("DELETE FROM users_role WHERE id_user = '$user'");
            $query = mysql_query("INSERT INTO users_role(id_user, role) VALUES ('$user', '$position')");
            return "Роль було назначено.";
        }
    }

    public function get_users()
    {
        $users = array();
        $bd = DB::connect();
        $query = mysql_query("SELECT id, name FROM users ORDER BY name");
        $i=0;
        while ($row=mysql_fetch_array($query))
        {
            $users[$i]['name'] = $row['name'];
            $users[$i]['id'] = $row['id'];
            $i++;
        }
        return $users;
    }

    public static function get_news_rights()
    {
        $news = array();
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM rights WHERE global_name='Новини'");
        $i = 0;
        while ($row = mysql_fetch_array($query))
        {
            $news[$i]['id'] = $row['id'];
            $news[$i]['name'] = $row['name'];
            $news[$i]['global_name'] = $row['global_name'];
            $i++;
        }
        return $news;
    }

    public static function create_role($_POST)
    {
        $bd = DB::connect();
        extract($_POST);
        if ($news and $name)
        {
            for ($i=0; $i<count($news); $i++)
            {
                $cur_var = $news[$i];
                $query = mysql_query("INSERT INTO role(name, id_right) VALUES ('$name', '$cur_var')");
                if ($i == count($news) -1)
                    return "Новий тип користувача було створено!!!";
            }
        }
    }

    public static function login($login, $l_password)
    {
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM users WHERE login = '$login' AND password = '$l_password'");
        $row=mysql_fetch_array($query);
        if ($row)
        {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_log_in'] = $row['type'];
            header("Location: /news");
            return true;
        }
        else
            return -1;
    }

    public function get_user_inform()
    {
        $inform_user = array();
        $current_user = $_SESSION['user_id'];
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM users WHERE id='$current_user'");
        $row=mysql_fetch_array($query);
        $inform_user['name'] = $row['name'];
        $inform_user['surname'] = $row['surname'];
        $inform_user['position'] = $row['position'];
        $inform_user['avatar'] = $row['avatar'];
        $inform_user['login'] = $row['login'];
        $inform_user['mail'] = $row['mail'];
        
        return $inform_user;
    }

    public function register_user($user_name, $surname, $mail, $login,  $l_password, $r_password, 
        $group)
    {
        
        /*if ($_POST['position'] == "student")
            {
                $position = "Студент";
                $type = 1;
            }
            else
            {
                $position = "Викладач";
                $type = 2;
            }*/
        $position = "Студент";
        $bd = DB::connect();
        $query = mysql_query("INSERT INTO users(login, mail, type, name, surname, password, stud_group, position, avatar) VALUES ('$login', '$mail', '1', '$user_name', '$surname', '$l_password', '$group', '$position', '0')");
    }

    function get_user_role()
    {
        $bd = DB::connect();
        $user_id = $_SESSION['user_id'];
        $query = mysql_query("SELECT * FROM users_role WHERE id_user = '$user_id'");
        //$rows = mysql_num_rows($query);
        $def_name = "Користувач";
        if ($rows >= 1)
        {
            $row = mysql_fetch_array($query);
            $name = $row['role'];
            return $name;
        }
        else return $def_name;
    }

    function check_password($l_password, $r_password)
    {
        if ($l_password==null or $r_password==null)
            return "Поля з паролем мають бути заповненні.";
        else 
        {
            if (strlen($l_password) < 5)
                return "Пароль має містити щонайменше 5 символів.";
            else 
            {
                if ($l_password != $r_password)
                    return "Паролі не співпадають.";
            }
        }
    }

    function check_mail($mail)
    {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            return "Не правильно вказано E-mail.";
    }

    function check_nsl($name, $surname, $login, $group)     //check name, surname, mail
    {
        $error_list = array();
        if($name == null) array_push($error_list, "Поле Ім'я має бути заповненим.");
        if (!preg_match('/^[a-zA-Zа-яіёА-ЯЁІ\s\-]+$/u', $name))
            array_push($error_list, "Не правильно вказано поле Ім'я.");
        if (!preg_match('/^[a-zA-Zа-яіёА-ЯЁІ\s\-]+$/u', $surname))
            array_push($error_list, "Не правильно вказано поле Прізвище.");
        if (!$group == "" || !$group == null) 
        {
            if (!preg_match("#[А-ЯA-Z]{2}-\d{2}#", $group))
                array_push($error_list, "Не правильно введено групу.");
        }
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM users WHERE login = '$login'");
        $row = mysql_fetch_array($query);
        $numb_rows = mysql_num_rows($query);
        if ($numb_rows != 0) array_push($error_list, "Користувач з таким логіном вже існує.");
        if($surname == null) array_push($error_list, "Поле Прізвище має бути заповненим.");
        if($login == null) array_push($error_list, "Поле Login має бути заповненим.");
        return $error_list;
    }

     function check_nsl_edit($name, $surname, $login)     //check name, surname, mail
    {
        $error_list = array();
        if($name == null) array_push($error_list, "Поле Ім'я має бути заповненим.");
        if (!preg_match('/^[a-zA-Zа-яіёА-ЯЁІ\s\-]+$/u', $name))
            array_push($error_list, "Не правильно вказано поле Ім'я.");
        if (!preg_match('/^[a-zA-Zа-яіёА-ЯЁІ\s\-]+$/u', $surname))
            array_push($error_list, "Не правильно вказано поле Прізвище.");
        
        $bd = DB::connect();
        if ($login != "")
        {
            $query = mysql_query("SELECT * FROM users WHERE login = '$login'");
            $row = mysql_fetch_array($query);
            $numb_rows = mysql_num_rows($query);
            if ($numb_rows != 0) array_push($error_list, "Користувач з таким логіном вже існує.");
            if($login == null) array_push($error_list, "Поле Login має бути заповненим.");
        }
        if($surname == null) array_push($error_list, "Поле Прізвище має бути заповненим.");
        return $error_list;
    }

    function get_users_for_teacher()
    {
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM users WHERE type = '1'");
        $users = array();
        while ($row=mysql_fetch_array($query))
        {
            $users[$i]['login'] = $row['login'];
            $users[$i]['id'] = $row['id'];
            $i++;
        }
        return $users;
    }

    function get_current_teacher()
    {
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM users WHERE type = '2'");
        $users = array();
        while ($row=mysql_fetch_array($query))
        {
            $users[$i]['login'] = $row['login'];
            $users[$i]['id'] = $row['id'];
            $i++;
        }
        return $users;
    }

    function add_teacher($_POST)
    {
        extract($_POST);
        $new_teacher_id = $user;
        $query = mysql_query("UPDATE users SET type = '2' WHERE id='$new_teacher_id'");
        $query = mysql_query("UPDATE users SET position = 'Викладач' WHERE id='$new_teacher_id'");
    }

    function delete_teacher($_POST)
    {
        extract($_POST);
        $delete_teacher_id = $delete_user;
        $query = mysql_query("UPDATE users SET type = '1' WHERE id='$delete_teacher_id'");
        $query = mysql_query("UPDATE users SET position = 'Студент' WHERE id='$new_teacher_id'");
        
    }

    public static function get_all_groups()
    {
        $groups = array();
        $bd = DB::connect();
        $query_groups = mysql_query("SELECT DISTINCT stud_group FROM users GROUP BY stud_group");
        $i=0;
        while ($row=mysql_fetch_array($query_groups))
        {
            if ($row['stud_group'])
            {
                $groups[$i]['group'] = $row['stud_group'];
                $i++;
            }
        }
        return $groups;
    }

    public static function get_all_students($group)
    {
        $students = array();
        $my_group = $group;
        $bd = DB::connect();
        $query = mysql_query("SELECT * FROM users WHERE stud_group='$my_group'");
        $i=0;
        $num_row = mysql_num_rows($query);
        if ($num_row>=1)
        {
            while ($row=mysql_fetch_array($query))
            {
                $students[$i]['id'] = $row['id'];
                $students[$i]['name'] = $row['name'];
                $students[$i]['surname'] = $row['surname'];
                $i++;
            }
            return $students;
        }
        else
            return "Немає жодонго студента";
    }
}
?>