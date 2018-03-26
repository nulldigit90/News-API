# News API for PHP
### Version 1.0
### License: MIT
---

## Installation
- Get your API key here: https://newsapi.org/register
- Download or clone 
- Place in appropriate directory
- `<?php include "/path/to/news-api.php"; ?>`
---

## Usage
I really recommend placing your api key in a different file, or the recommended environment var, for examples on how to do that: https://www.schrodinger.com/kb/1842
```php

// Use getenv() instead of $_ENV, the later needs to be set in
// php.ini to work and is recommended not to be used in production
$key = getenv()["NEWS_API_KEY"];
$newsObj = new NewsApiClient($key);
$args = array('language'=>'en',
	        'pageSize'=>'30',
            'sources'=>array("ign", "hacker-news", "techradar",
                            "wired", "the-next-web",  "techcrunch"));

// returns a JSON file of articles
$obj = $newsObj->get_top_headlines($args);
var_dump($obj);
```
Further example found in `index.php`

---

## For a list of further examples and parameters:
- View the source code found in `news-api.php`
- OR on their website https://newsapi.org/docs
---
## To-Do
- Images from IGN aren't working atm
- Add article duplicate check with in the library
- Add support to filter articles on content (or lack there of)
- Create WordPress Plugin