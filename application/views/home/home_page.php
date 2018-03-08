<content>
	<div id="container" style="text-align: center;">
		<h1>저의 사이트에 오신것을 환영합니다!</h1><br>
		<?php
			if($this->session->userdata('logged_in') == TRUE) :
		?>
		<div>
			<h4>환영합니다, <?php echo $this->session->userdata('user_id') ?>님!</h4>
			<h5>로그인 정보</h5>
			<p>ID : <?php echo $this->session->userdata('user_id') ?></p>
			<p>NAME : <?php echo $this->session->userdata('user_name') ?></p>
			<p>EMAIL : <?php echo $this->session->userdata('user_email') ?></p>
		</div>
		<?php 
			else :
		?>
		<div>
			<h4>로그인을 해주세요.</h4>
			<a href="/index.php/auth/get_login">로그인</a><br>
		</div>
		<?php
			endif;
		?>
		</div>
</content>


