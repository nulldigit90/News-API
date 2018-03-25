<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<?php include "ziplib.php"; ?>
	<title>News API</title>
</head>
<body>
	<div class="container">
		<ul class="article_list">
			<?php
			// Use getenv() instead of $_ENV, the later needs to be set in
			// php.ini to work and is recommended not to be used in production
			$key = getenv()["NEWS_API_KEY"];
			$newsObj = new NewsApiClient($key);
			$args = array('language'=>'en',
						'pageSize'=>'30',
						'sources'=>array("ign", "hacker-news", "techradar", "wired", "the-next-web", "techcrunch"));
			
			$obj = $newsObj->get_top_headlines($args);
			$article_list = array();

			// if any of the data has null or no values for the things we want to post
			//   skip them. Not every article will have everything we need
			for ($i=0; $i < count($obj["articles"]); $i++) {
				if ( !is_null($obj["articles"][$i]['url']) and 
					!is_null($obj['articles'][$i]['title']) and 
					!is_null($obj['articles'][$i]['urlToImage']) and 
					!is_null($obj['articles'][$i]['description']) and
					!is_null($obj['articles'][$i]['author']) ) {
						// checking for duplicates
						if (!in_array($obj['articles'][$i]['title'], $article_list)) {
							// push title to array to check on next loop
							array_push($article_list, $obj['articles'][$i]['title']);

							// ugly echo html, at least we give the elements classes for css
							echo "<li class=\"article_entry\"><a target=\"_blank\" href=\"". $obj["articles"][$i]['url'] . "\">";
							echo "<h2 class=\"article_title\">" . $obj["articles"][$i]['title'] . "</h2>";
							echo "<h3 class=\"article_publisher\"> From: " . $obj['articles'][$i]['source']['name'] . "</h3>";
							echo "<img class=\"article_image\" src=\"". $obj['articles'][$i]['urlToImage'] . "\">";
							echo "<p class=\"article_description\">" . $obj['articles'][$i]['description'] . "</p>";
							echo "</li></a>";
						}
					}
			}
			
			?>
		</ul>
	</div>
</body>
</html>