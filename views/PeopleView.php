<?php $lang = $_SESSION['lang']; require_once(ROOT. '/language/'.$lang.'.php'); ?>
<body>
<script>
function myFunction() {	
    var x = document.getElementById("search_field").value;
    if (x == "")
    	x = "full_list_people";
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("people_list").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","/functions/function.php?people_list="+x,true);
    xmlhttp.send();
}

function copy_text(lol) {
	//document.getElementById("modal_message_message").value = lol;
	document.getElementById("lalka").innerHTML = lol;
}

function alert_var() {
	//alert("alert_var");
	//var receiver = document.getElementById("lalka").value;
	//alert(receiver);
	var x = '<?php echo $_POST['login'];?>';
	var message_theme = document.getElementById("modal_message_message").value;
	var message_content = document.getElementById("modal_message_message_content").value;
	//alert(message_theme + message_content);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("people_list").innerHTML = xmlhttp.responseText;
        }
    };
	xmlhttp.open("GET", "/functions/function.php?message_theme="+message_theme+"&message_content="+message_content, true);
	xmlhttp.send();
	//alert(x);
}

function add_friend_function(input)
{
	//alert("add_friend_function");
	var friend = input.name;
	//alert(friend+"yes");
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //document.getElementById("people_list").innerHTML = xmlhttp.responseText;
        }
    };
	xmlhttp.open("GET", "/functions/function.php?add_friend="+friend, true);
	xmlhttp.send();
	
}

function delete_friend_function(input) {
	var friend = input.name;
	//alert(friend+"yes");
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //document.getElementById("people_list").innerHTML = xmlhttp.responseText;
        }
    };
	xmlhttp.open("GET", "/functions/function.php?delete_friend="+friend, true);
	xmlhttp.send();

}

function work_with_friends(input) {
	if (input.value == "Долучити до друзів")
	{

		
		//alert(input.value);
		input.value = "Видалити з друзів";
		add_friend_function(input);
	}
	else
	{
		input.value = "Долучити до друзів";
		delete_friend_function(input);
	}
}
</script>
<?php require_once(ROOT. '/templates/header.php'); ?>
<div class="page">
	<div class="container"  id="full">
    	<div id="fs_content">
    		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="sidebar_menu">
      			<?php include '/templates/sidebar.php'; ?>
    		</div>
		    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="site_content">

		    	<p id="nav_name"><?php //echo $reg_reg;?>Люди на сайті<p>
					<div id="content_writing_style">
						<form method="post">
							<div class="input-group" >
								<input type="text" onkeyup="myFunction()" class="textbox1" id="search_field" name="login" value = "<?php echo $_POST['login'] ?>" >

								<div class="input-group-addon" id="height_30px"><!--<span class="glyphicon glyphicon-knight" id="glyph_register_height"></span>-->Пошук</div>
							</div><br>
						</form>
						

						
						<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12" id="register_field_left">
							<div id="people_list">
							<?php foreach($people_arr as $comment) : ?>
								<div id="pract_reply_block">
									<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
										<div id="pract_reply_block_avatar">
											<img src="/images/avatar/<?php echo $comment['avatar'].'.jpg'; ?>"  alt="" id="comment_avatar" >
										</div>
									</div>
									<font id="some_cool_font">
									<div class="col-lg-7 col-md-6 col-sm-5 col-xs-5">
										<div id="pract_reply_block_message">
											<font id="name_surname_comment">
												<?php echo $comment['name'].' '.$comment['surname']; ?>
											</font> <br>
											<font id="name_surname_comment">
												ID користувача : <?php echo $comment['id']; ?>
											</font> <br>		
											<?php echo $comment['reply']; ?><br><br>
											<?php echo $comment['datetime'];?>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
										<button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal" onclick="copy_text(this.value)" id="people_button" value="<?php echo $comment['name'].' '.$comment['surname'];?>">Повідомлення</button>
										<div id="block_add_friend">
										<?php if(in_array($comment['id'], $friend_arr)) : ?>	
										<input type="button" class="btn btn-default btn-block" onclick="work_with_friends(this)" id="people_button" argument="<?php echo $comment['id'];?>" name="<?php echo $comment['id'];?>" value="Видалити з друзів">
										<?php else : ?>
										<input type="button" class="btn btn-default btn-block" onclick="work_with_friends(this)" id="people_button" argument="<?php echo $comment['id'];?>" name="<?php echo $comment['id'];?>" value="Долучити до друзів">
										<?php endif;?>
										</div>
									</div>
									</font>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
						<div class="col-lg-3 col-md-5 col-sm-4 col-xs-12" id="people_right_panel">
						</div>
					</div>
		    </div>
  		</div>
  	</div>
 	<div class="container" id="fulls">
    	<?php include '/templates/footer.php'; ?> 
  	</div>
</div>
<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" id="modal_message_position" role="document">
    <div class="modal-content">
      <div class="modal-header" id="modal_header_bg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Написати повідомлення</h4>
      </div>
      <div class="modal-body" id="modal_content_bg">
        <form method="post" id="message_form">
        	
			<!--<div class="input-group" >-->
			<font id="modal_message_title">Отримувач : </font><!--<input type="text" onkeyup="myFunction()" class="textbox1" id="modal_message_message" name="login" value = "<?php echo $_POST['login'] ?>" >--><!--<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-knight" id="glyph_register_height"></span></div>-->
			<font id="lalka"></font>
			<!--</div><br>-->
			<!--<div class="input-group" >-->
				<!--<div class="input-group-addon" id="height_30px"><span class="glyphicon glyphicon-knight" id="glyph_register_height"></span></div>-->
			<p id="modal_message_title">Тема : </p><input type="text" class="textbox1" id="modal_message_message" name="login" >
			<!--</div><br>-->
			<p id="modal_message_title">Повідомлння : </p><textarea class="textbox1"  name="content" id="modal_message_message_content"   ><?php echo $_POST['content'] ?></textarea><br>
		</form>
      </div>
      <div class="modal-footer" id="modal_content_bg">
        <button type="button" class="btn btn-default" data-dismiss="modal">Відмінити</button>
        <button type="button" type="submit" form="message_form" onclick="alert_var()" value="submit" class="btn btn-primary" data-dismiss="modal">Надіслати повідомлення</button>
      </div>
    </div>
  </div>
</div>
</body>