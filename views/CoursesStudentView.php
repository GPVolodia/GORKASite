<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<body>
<?php require_once(ROOT. '/templates/header.php'); ?>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">
		    	<p id="nav_name">Мої курси<p>
					<div id="content_writing_style">
						<font id="comment_more">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<?php foreach($user_courses as $cours): ?>
								<div id="curr_course_output">
									<font id="curr_course_name"><a href="/courses/<?php echo $cours['course_id']; ?>"><?php  echo $cours['course_name'];?></a></font><br>
									Викладач : <?php echo $cours['teacher_name']; ?> <?php echo " "; ?><?php echo $cours['teacher_surname'];?>
								</div>
							<?php endforeach;?>
						</div>
						</font>
					</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
</body>