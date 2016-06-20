<html>
<head>
<script type="text/javascript">
function check_input() {
	var password = document.forms['form1'].elements['password'].value;
	
	if (password == null || password == "")
	{
		alert("Enter the password!");
		return false;
	}else if (password != 'admin')
	{
        alert("Wrong password!");
        return false;
    }
}

</script>
</head>
<body>
	<b>Admin GUESTBOOK</b><br>
	<?php if($validation):?>
		<?php if($messages) : ?>
		<?php foreach($messages as $mes) : ?>
		<div id="message_block" style="border:solid 1px black; margin-top:10px;">
			Name : <?php echo $mes['name'];?> <br>
			Email : <?php echo $mes['email'];?> <br>
			Message : <?php echo $mes['message'];?> <br>
			<a href="/delete/<?php echo $mes['id'];?>">Delete message</a>
		</div>
		<?php endforeach;?>
		<?php endif;?>
	<?php else :?>
	Password - 'admin'
	<form method="post" id="form1" onsubmit="return check_input();">
		Password: <input type="text" name="password" value = ""><br>
		<button form="form1" type="submit" name="submit" value="submit">Submit</button>
	</form>
	<?php endif;?>
	
</body>
</html>