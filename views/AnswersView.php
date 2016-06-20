<body>
<?php require_once(ROOT. '/templates/header.php'); ?>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">

		    	<p id="nav_name">Повідомлення від користувачів<p>
					<div id="content_writing_style">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="register_field_left">
							<font id="some_cool_font">
							<table class="table table-hover">
							 	<thead>
									<tr>
										<th><font id="some_cool_font">Ім'я</font></th>
										<th><font id="some_cool_font">Повідомлення</font></th>
										<th><font id="some_cool_font">Дата</font></th>
										<th><font id="some_cool_font">IP</font></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($messages as $mess) : ?>
										<tr>
											<td><font id="some_cool_font"><?php echo $mess['name'];?></font>
											<td><font id="some_cool_font"><?php echo $mess['message'];?></font>
											<td><font id="some_cool_font"><?php echo $mess['date'];?></font>
											<td><font id="some_cool_font"><?php echo $mess['ip'];?></font>
										</tr>
									<?php endforeach;?>
								</tbody>
							 </table>
							</font>
							<ul class="pagination" id="my_pag">
								<li><a href="/message/<?php echo $current_page-1;?>">«</a></li>
								<?php for ($i=1; $i<=$page_count; $i++) : ?>
							  	<li><a href="/message/<?php echo $i;?>"><?php echo $i;?></a></li>
								<?php endfor; ?>
								<li><a href="/message/<?php echo $current_page+1;?>">»</a></li>
							</ul>
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