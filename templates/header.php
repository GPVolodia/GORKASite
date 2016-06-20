<?php session_start();  ?>
<?php if ($_SESSION['lang']) $lang = $_SESSION['lang']; else $lang = "UA"; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GORKASite</title>

    <!-- Bootstrap -->
    <link href="/css/mf.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="edit.js"></script>
<nav class="navbar navbar-inverse">
  <div class="container-fluid" id="black_bg">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" id="logo_padding"><font id="red_color">GORKAS</font>ite</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <?php $query = mysql_query("SELECT * FROM languages");
                if ($query) 
                {
                    while($row = mysql_fetch_array($query))
                    {
                        $lang = $row['language'];
                        echo '<li><a href="index.php?language='.$lang.'">'.$lang.'</a></li>';
                        

                    }
                }
            ?>
            
            <li><a href="/registration"><span class="glyphicon glyphicon-user" id="glyph_nav_size"></span> <?php echo $head_reg?></a></li>
            <li><a href="/feedback"> <span class="glyphicon glyphicon-send" id="glyph_nav_size"></span>   <?php echo $head_feed?></a></li>      
<?php 
                if ($_SESSION['user_id'] != 0) 
                    echo '<li><a href="/logout"><span class="glyphicon glyphicon-log-out" id="glyph_nav_size"></span> '.$head_out.'</a></li>';
                else
                    echo '<li><a href="/login"><span class="glyphicon glyphicon-log-in" id="glyph_nav_size"></span> '.$head_in.'</a></li>';
            ?>   
      </ul>
    </div>
  </div>
</nav>
  



                                         

