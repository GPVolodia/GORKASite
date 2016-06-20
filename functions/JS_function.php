<?php 

class JS_function 
{
	public static function operation_ok()
	{
		echo "lol";
		echo "<script> operation_ok(); </script>";
	}
}


?>


<script type="text/javascript">
function operation_ok() {
	alert("x");
    document.getElementById("op").innerHTML = "xmlhttp.responseText";
}
</script>