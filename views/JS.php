<html>
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript">
		/*function fib(number)
		{
			if (number == 1 || number ==2)
				return 1;
			else
				return fib(number-1)+fib(number-2);
		}
		for (var i=1; i<15; i++)
			document.write(fib(i) + '<br>');
		
		document.write(res);*/
		//document.write(Math.PI);

		$(document).ready(function(){
			$("h1").css("color", "red");
			$("div#content article#stick").css("color", "blue");
		});
		//$("#content").css('color')
		$(document).ready(function(){
			$("#font_size_increase").on('click',function(){
				$("#my").css('font-size', function(i, value){
				return parseFloat(value) + 10;});
			})
			$("#font_size_decrease").on('click', function(){
				$("#my").css('font-size', function(i, value){
					return parseFloat(value) - 10;
				});
			});
			$("#font_size_show").on('click', function(){
				$("#my").show('slow');
				$("#my_new").show('slow');
			});
			$("#font_size_hide").on('click', function(){
				$("#my").hide('slow');
			});
			$("#font_size_animate").on('click', function(){
				$("my").animate({right:'+=100'});
			});
			$("#font_size_replace").on('click', function(){
				$("my").replcaeWith("#my_new");
			});
			$("#form_send").submit(function(){
				//alert('seund');
				$('.error').remove();
				if ($(this).find('input[name=user]').val() == '') {
					$(this).find('input[name=user]').before('<div class="error">Введите имя</div>');
					return false;
				}
				$.post(
					$(this).attr('action'), // ссылка куда отправляем данные
					$(this).serialize()
				);
				return false;
			});
			
		})
		
		//document.write($("#stick").css("color"));
		
	</script>
</head>
<body>
	<button class="btn btn-default" id="font_size_increase">+</button>
	<button class="btn btn-default" id="font_size_decrease">-</button>
	<button class="btn btn-default" id="font_size_show">Show</button>
	<button class="btn btn-default" id="font_size_hide">Hide</button>
	<br><br>
	<form id="form_send">
		<input type="text" name="user" value=""/>
			<select name="role">
				<option>User</option>
				<option>Admin</option>
			</select>
		<input type="submit">
	</form>
	<div id="your_input"></div>
	<div id="my" style="color:blue;">frefe</div>
	<div id="content" class="wrapper box">
		<hgroup>
			<h1>Page Title</h1>
			<h2>Page Description</h2>
		</hgroup>
		<article id="stick">
			<h2>Article Title</h2>
			<p>Lorem ipsum dolor sit amet, consectetuer adipisci</p>
		</article>
		<article>
			<h2>Article Title</h2>
			<p>Morbi malesuada, ante at feugiat tincidunt, enim massa gravida
			metus, commodo lacinia massa diam vel eros.</p>
		</article>
		<footer>
			<p>&copy;copyright 2012</p>
		</footer>
	</div>
</body>
<html>