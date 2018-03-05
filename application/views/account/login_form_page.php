<content id="content">	
	<div id="container" class="container-fixed" style="text-align: center;">
		<a class="brand">환영합니다. 로그인해주세요.</a>
		<?php echo validation_errors(); ?>
		<form action="/index.php/auth/get_login" method="post">
			<input type="text" id="id" name="id" value="" placeholder="ID"/>
			<br>
			<input type="password" id="password" name="password" value="" placeholder="PASSWORD"/><br>
			<input class="btn" type="submit" name="submit" value="Login"/>
		</form>
		<input class="btn" type="button" name="getAccount" value="Sign Up" onClick="location.href = '/index.php/account/create_account'"/>
	</div>
	<a href="/index.php/main/">돌아가기</a>
</content>