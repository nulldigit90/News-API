<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<?php include "ziplib.php"; ?>
	<title>ZipNews</title>
</head>
<body>
	<div class="container">
		<ul class="article_list">
			<?php

			$newsObj = new NewsApiClient('DaminIt_Ineed_EnvVars_');
			$n = $newsObj->get_sources('');
			print_r($n);
			
			?>
		</ul>
	</div>
</body>
</html>