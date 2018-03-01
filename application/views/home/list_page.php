<ul>
	<li><a href="/index.php/main">홈으로 돌아가기</a></li>
	<li><a href="/index.php/main/get_topics">get_topics로 돌아가기</a></li><br>
<?php
	foreach ($topics as $entry) {
	?>
		<li><a href="/index.php/main/get_topic/<?=$entry->id?>"><?= $entry->title ?></a></li>
	<?php
	}
?>	
</ul>