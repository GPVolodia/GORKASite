<?php if ($_SESSION['lang']) $lang = $_SESSION['lang']; else $lang = "UA"; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<body>
<?php require_once(ROOT. '/templates/header.php'); ?>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">
		    	<p id="nav_name">Новини<p>
					<div id="content_writing_style">
						

						<?php foreach($news_list as $cur_new) : ?>
						<div id="news_element">
							<font id="news_list_title"><a href="/news/<?php echo $cur_new['id'];?>" id="gert"><?php echo $cur_new['title']; ?></a></font>
							<div class="comment more" id="comment_more">
								<?php echo $cur_new['content']; ?>
								
							</div>
							<?php if ($cur_new['picture']) : ?>
							<div id="news_list_picture">
							<?php echo '<img src="/documents/news/'.$cur_new['picture'].'"" class="img-rounded" id="news_list_picture">'; ?>
							</div>		
							<?php endif;?>
							<?php if ($cur_new['video']) : ?>
								<div class="responsive-video">
									<?php if ($cur_new['video']) echo '<iframe title="YouTube video player" width="501" height="346" src="'.$cur_new['video'].'"  frameborder="0" allowfullscreen></iframe><br>';?>
								</div>
							<?php endif;?> <br>
							<font id="news_list_author"><?php echo $main_auth;?> </font><span class="glyphicon glyphicon-user"></span>
							<font id="news_list_author_write"><?php echo $cur_new['name'].' '.$cur_new['surname']; ?></font>

							<font id="news_list_author"> ,  <?php echo $main_date;?> : </font><span class="glyphicon glyphicon-time"></span>
							<font id="news_list_author_write"><?php echo $cur_new['datetime'];?> , </font>
							<font id="com_num"><?php echo $cur_new['num_com'].' ';?></font><span class="glyphicon glyphicon-comment"></span>

							<?php if($edit_news_rights) : ?>
							, 
							<font id="news_list_author">
								<a href="/news/edit/<?php echo $cur_new['id'];?>"> <?php echo $main_edit;?>, </a>
								<a href="/news/delete/<?php echo $cur_new['id'];?>"><?php echo $main_del;?></a>
							</font>
							<?php endif;?>
						</div>
						<?php endforeach;?>

					</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
</body>