<?php foreach($people_list_arr as $comment) : ?>
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
			<?php echo $comment['reply']; ?><br><br>
			<?php echo $comment['datetime'];?>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		<button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal" id="people_button">Повідомлення</button>
		<button type="button" class="btn btn-default btn-block" id="people_button">Долучити до друзів</button>
	</div>
	</font>
</div>
<?php endforeach; ?>