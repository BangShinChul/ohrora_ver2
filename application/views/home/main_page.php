
<?php
	if($this->session->userdata('logged_in') == TRUE) :
?>
<div>
	<h4>환영합니다, <?php echo $this->session->userdata('user_id') ?>님!</h4>
	<a href="/index.php/main">홈으로 돌아가기</a><br>
	<a href="/index.php/auth/get_logout">로그아웃</a><br>
</div>
<?php 
	else :
?>
<div>
	<h4>로그인을 해주세요.</h4>
	<a href="/index.php/auth/get_login">로그인</a><br>
	<a href="/index.php/main">홈으로 돌아가기</a><br>
</div>
<?php
	endif;
?>