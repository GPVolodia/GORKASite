	<html>
<head>
</head>

<body>
<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>  
<?php 
$bd = DB::connect();
$user_id = $_SESSION['user_id'];
$query_get = mysql_query("SELECT * FROM users WHERE id='$user_id' and type='2'");
$query_get_write = mysql_query("SELECT * FROM users LEFT JOIN users_role ON users.id = users_role.id_user
    LEFT JOIN role ON users_role.role = role.name WHERE users.id='$user_id' and id_right=1");
$query_num_coment = mysql_query("SELECT * FROM news_comment WHERE publish = 0");
$num_coment = mysql_num_rows($query_num_coment);
$num_rowsss = mysql_num_rows($query_get);
$query_edit_news = mysql_query("SELECT * FROM users WHERE id='$user_id'");

//$write_news = mysql_num_rows($query_get_write);
?>
<div class="sidebar">
        
        <div class="gadget">
          <h2 class="star"><?php echo $sidebar_main_menu?></h2>
          <div class="clr"></div>
          <ul class="sb_menu">
          	<li><a href="/news">Новини</a></li>
            <!--<li><a href="index.php?sidebar=my_courses">Мої курси</a></li>
            <li><a href="index.php?sidebar=journal">Журнал оцінок</a></li>-->
            <li><a href="/profile"><?php echo $sidebar_prof?></a></li>
            <li><a href="/courses">Мої курси</a></li>
            <?php 
             
              if ($num_rowsss >= 1)
              {
                echo '<li>';
                 echo '<div id="number_com">';
                //echo '<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="margin-20px">';
                echo '<a href="/comments">'.$sidebar_comment.'';echo '</a> ';
                //echo '</div>';

                if ($num_coment >=1)
                  echo '<a href="/comments"><div class="pull-right" id="some_id_fre">'.$num_coment.'</div></a>';
                echo '</div>';
                echo '</li>';
              }
              
              
              
            ?>

            <!--<li><a href="/friends"><?php //echo $sidebar_prof?>Мої друзі</a></li>-->
            <!--<li></li>
            <li><a href="/people"><?php //echo $sidebar_prof?>Люди на сайті</a></li>-->
          </ul>
        </div>

        <?php

        if ($_SESSION['user_log_in'] == 2)
        {


           echo 
          '<div class="gadget">
            <h2 class="star">'.$sidebar_teacher.'</h2>
            <div class="clr"></div>
              <ul class="ex_menu">
                  <li><a href="/news/write">'.$sidebar_news.'</a><br />
                    Добавлення новини по курсу</li>';

          echo '
              </ul>
            </div>
          </div>';
        }
        else
        {
          if ($_SESSION['user_log_in'] == 1)
          {
            echo 
            '<div class="gadget">
              <h2 class="star">'./*$sidebar_student.*/'</h2>
              <div class="clr"></div>
                <ul class="ex_menu">
                  
                  ';
                  if ($write_news >= 1)
                    echo ' <li><a href="/news/write">'.$sidebar_news.'</a><br />
                    Добавлення новини по курсу</li>';
            echo '                    
                </ul>
              </div>
            </div>';
          }
          else 
          {
            if ($_SESSION['user_log_in'] == 100)
            {
              echo 
              '<div class="gadget">
                <h2 class="star">'.$sidebar_admin.'</h2>
                <div class="clr"></div>
                  <ul class="ex_menu">
                    <li><a href="/news/write">'.$sidebar_news.'</a><br />
                    Добавлення новини по курсу</li>
                    
                    <li><a href="/user_rights">'.$sidebar_role.'</a><br />
                    Редагування та зміна прав користувачів</li>
                  </ul>
                </div>
              </div>';
            }
            else
            echo 
            '<div class="gadget">
              <h2 class="star"> </h2>
              <div class="clr"></div>
                
              </div>
            </div>';
          }
        }

        ?>
        


</body>

</html>