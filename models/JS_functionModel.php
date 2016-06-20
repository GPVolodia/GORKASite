<script>
function opp()
{
	
	document.getElementById("op").innerHTML = "GET_back";
}
</script>


<?php 
class JS_functionModel 
{
	public static function operation_ok()
	{

		echo '<script> opp(); </script>';
	}
}
?>


