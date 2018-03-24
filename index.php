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

			$newsObj = new NewsApiClient('89bc62b353d64eaaafff3bb2a825e60d');
			$n = $newsObj->get_sources('');
			print_r($n);
			
			?>
		</ul>
	</div>
</body>
</html>