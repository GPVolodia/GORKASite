<body>
<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<?php require_once(ROOT. '/templates/header.php'); ?>
<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">

		    	<p id="nav_name">			<?php echo $error404;?><p>
					<div id="content_writing_style">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="register_field_left">
							<font id="some_cool_font">
							
				
						</font>
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