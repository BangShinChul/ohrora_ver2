	
	
	<div id="body" class="container-fixed" style="text-align: center;">
		<span style="text-align: center; padding: 0; margin: 0;"><h5>회원가입</h5></span>
		
		<?php echo validation_errors(); ?>
		
		<form action="/index.php/account/create_account" method="post">
			<input type="hidden" id="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
			<input type="text" id="id" name="id" value="" placeholder="ID"/>
			<br>
			<input type="password" id="password" name="password" value="" placeholder="PASSWORD"/><br>
			<input type="password" id="password_chk" name="password_chk" value="" placeholder="PASSWORD CHECK"/><br>
			<input type="text" id="name" name="name" value="" placeholder="Your name"/><br>
			<input type="email" id="email" name="email" value="" placeholder="Your Email"/><br>
			
			<input class="btn" type="submit" name="submit" value="Submit"/>
		</form>
	</div>
	<a href="/index.php/main/">돌아가기</a>