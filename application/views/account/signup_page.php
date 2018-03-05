	<div id="body" class="container-fixed" style="text-align: center;">
		<a class="brand">회원가입 페이지입니다.</a>
		<?php echo validation_errors(); ?>
		<form action="/index.php/account/create_account" method="post">
			<input type="text" id="id" name="id" value="" placeholder="ID"/>
			<br>
			<input type="password" id="password" name="password" value="" placeholder="PASSWORD"/><br>
			<input type="password" id="password_chk" name="password_chk" value="" placeholder="PASSWORD CHECK"/><br>
			<input class="btn" type="submit" name="submit" value="Submit"/>
		</form>
	</div>
	<a href="/index.php/main/">돌아가기</a>