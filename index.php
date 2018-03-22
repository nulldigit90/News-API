<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<?php include "zipnewsdev.php"; ?>
	<title>ZipNews</title>
</head>
<body>
	<div class="container">
		<ul class="article_list">
			<?php 
			$news = new News;
			$news->zipnews(); ?>
		</ul>
	</div>
</body>
</html>