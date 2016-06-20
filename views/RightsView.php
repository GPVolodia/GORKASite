<!--<form method='post' > 
<input type="checkbox" name="options[]" value="повна комплектація" /> повна комплектація 
<input type="checkbox" name="options[]" value="шкіра" />шкіра 
<input type="checkbox" name="options[]" value="кондиціонер" />кондиціонер 
<input type="checkbox" name="options[]" value="клімат контроль" />клімат контроль 
<br> 
<input type='submit' name='submit' id='submit' value='Додати оголошення'> 
</form> 
-->
<script >
function showUser(str) {
	if (str == "") {
	    document.getElementById("txtHint").innerHTML = "";
	    return;
	} else { 
	    if (window.XMLHttpRequest) {
	        // code for IE7+, Firefox, Chrome, Opera, Safari
	        xmlhttp = new XMLHttpRequest();
	    } else {
	        // code for IE6, IE5
	        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
	        }
	    };
	    xmlhttp.open("GET","/functions/function.php?role_description="+str,true);
	    xmlhttp.send();
	}   
    
}

</script>

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

		    	<p id="nav_name"><?php echo $role_head;?><p>
					<div id="content_writing_style">

						<font id="comment_more">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<font id="big_title">Додати користувача до групи викладачі.</font><br><br>
							<form method="post" id="form1">
								
								<?php echo $role_user;?> :<br>
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-star-empty" id="glyph_register_height"></span></div>
									<select name="user" size="1" class="textbox2" id="my_tb2">
									<?php foreach($users_for_teacher as $user) : ?>
									<option value="<?php echo $user['id'];?>"><?php echo $user['login'];?></option>
									<?php endforeach;?>	
									</select>
								</div><br>	
							<button form="form1" value="Підтвердити" name="add_teacher" type="submit" class="btn btn-default" id="my_edit_button"><span class="glyphicon glyphicon-ok" id="glyph_edit_profile_height"></span> <?php echo $role_submit;?></button>
							</form>
							
						</div>
						
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="margin-20px">
							<font id="big_title">Прибрати права викладача у користувача.</font><br><br>
							<form method="post" id="form2">
								
								Прибрати права у даного користувача :<br>
								<div class="input-group" >
									<div class="input-group-addon" id="height_30px"><span class="	glyphicon glyphicon-star-empty" id="glyph_register_height"></span></div>
									<select name="delete_user" size="1" class="textbox2" id="my_tb2">
									<?php foreach($teacher_users as $user) : ?>
									<option value="<?php echo $user['id'];?>"><?php echo $user['login'];?></option>
									<?php endforeach;?>	
									</select>
								</div><br>	
							<button form="form2" value="Підтвердити" name="delete_teacher" type="submit" class="btn btn-default" id="my_edit_button"><span class="glyphicon glyphicon-remove" id="glyph_edit_profile_height"></span> <?php echo "Прибрати права";?></button>
							</form>

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