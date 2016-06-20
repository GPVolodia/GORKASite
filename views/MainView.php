<html>
<head>
<script type="text/javascript">
function check_input() {
	var name = document.forms['form1'].elements['name'].value;
	var email = document.forms['form1'].elements['email'].value;
	var message = document.forms['form1'].elements['message'].value;

	if ((name == null || name == "") || (email == null || email == "") || (message == null || message == ""))
	{
		alert("Fill all the fields!");
		return false;
	}
		
	var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
}

</script>
</head>
<body>
	<h1><b>Guestbook</b></h1>
	<h2>Go to admin page add to url - '/admin'</h2>
	<h2>Go to timer add to url - '/timer'</h2>
	<form method="post" id="form1" onsubmit="return check_input();">
		Name: <input type="text" name="name" value = ""><br><br>
		Email: <input type="text" name="email" value = ""><br><br>
		Message: <textarea  name="message" ></textarea><br><br>		
		<button form="form1" type="submit" name="submit" value="submit">Submit</button>
	</form>
	<?php if($messages) : ?>
	<?php foreach($messages as $mes) : ?>
	<div id="message_block" style="border:solid 1px black; margin-top:10px;">
		Name : <?php echo $mes['name'];?> <br>
		Email : <?php echo $mes['email'];?> <br>
		Message : <?php echo $mes['message'];?> <br>
	</div>
	<?php endforeach;?>
	<?php endif;?>
</body>
</html>