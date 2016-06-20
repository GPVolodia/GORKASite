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
		    	<p id="nav_name"><?php echo $prof_my;?><p>
				<div id="content_writing_style">
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id="margin-20px">
						<div id="profile_avatar">
							<?php echo '<img src="images/avatar/'.$information['avatar'].'.jpg"  alt="" id="profile_avatar" >';?>
						</div>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="margin-20px">
						<div id="profile_inform">
							<ul id="profile_list">
								<li><?php echo $prof_name;?> : <p id="profile_inf_db"><?php echo $information['name'];?></li></p>
								<li><?php echo $prof_sur;?> : <p id="profile_inf_db"><?php echo $information['surname'];?></li></p>
								<li><?php echo $prof_pos;?> : <p id="profile_inf_db"><?php echo $information['position'];?></li></p>
								<li><?php echo $prof_mais;?> : <p id="profile_inf_db"><?php echo $information['mail'];?></li></p>
								<li><?php echo $prof_log;?> : <p id="profile_inf_db"><?php echo $information['login'];?></li></p>
								
							</ul>
						</div>
						<div id="block_of_buttons">
							  <a href="/profile/edit_profile"><button type="button" class="btn btn-default" id="my_edit_button"><?php echo $prof_edit;?></button></a>
						</div>
					</div>
				</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
</body>