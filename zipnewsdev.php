<?php 

class News 
{
    // Urls and paramaters needed
    private $base_url = "https://newsapi.org/v2/";
    private $headline_uri = "";

    // page_size max 100
    // $sources can be anything found here https://newsapi.org/sources
    // KEEP YOUR API KEY PRIVATE
    public $page_size = "pageSize=";
    private $api_key = "apiKey=89bc62b353d64eaaafff3bb2a825e60d";

    public $default_sources = array("ign", "hacker-news", "techradar", "wired", "the-next-web", "techcrunch");

    public function __construct($d_source=[], $psize=10, $top_or_every=true)
    {
        $this->page_size .= $psize;

        $top_or_every ? $this->headline_uri .= "top-headlines?language=en&" : $this->headline_uri .= "everything?language=en&";

        !empty($d_source) ? $this->default_sources = $d_source : $this->default_sources = $this->default_sources;
    }

    public function zipnews()
    {
        // building the url
        $_sources = "sources=" . implode(",", $this->default_sources);
        $_url = implode("&", array($this->page_size, $_sources, $this->api_key));
        $news_url = $this->base_url . $this->headline_uri . $_url;
        //echo $news_url;

        // request with the api and grab the json data
        $json = file_get_contents($news_url);
        $obj = json_decode($json, true);

        // array to hold headlines so we can check for duplicates
        $article_list = array();

        // if any of the data has null or no values for the things we want to post
        //   skip them. Not every article will have everything we need
        for ($i=0; $i < count($obj["articles"]); $i++)
        {
            // yes, they can be and a lot are, null
            if ( !is_null($obj["articles"][$i]['url']) and 
                !is_null($obj['articles'][$i]['title']) and 
                !is_null($obj['articles'][$i]['urlToImage']) and 
                !is_null($obj['articles'][$i]['description']) and
                !is_null($obj['articles'][$i]['author']) )
            {
                
                /* checking for duplicates
                * #### NOTE #######
                * # This might make page size smaller
                * # as in the default of 10 or what you set it as
                * # might and probably will be less than what you think it should be
                * # I haven't compensated for duplicates that will happen ~cough~ often
                * #################
                */
                if (!in_array($obj['articles'][$i]['title'], $article_list))
                {
                    // push title to array to check on next loop
                    array_push($article_list, $obj['articles'][$i]['title']);

                    // ugly echo html, at least we give the elements classes for css if we need
                    echo "<li class=\"article_entry\"><a target=\"_blank\" href=\"". $obj["articles"][$i]['url'] . "\">";
                    echo "<h2 class=\"article_title\">" . $obj["articles"][$i]['title'] . "</h2>";
                    echo "<h3 class=\"article_publisher\"> From: " . $obj['articles'][$i]['source']['name'] . "</h3>";
                    echo "<img class=\"article_image\" src=\"". $obj['articles'][$i]['urlToImage'] . "\">";
                    echo "<p class=\"article_description\">" . $obj['articles'][$i]['description'] . "</p>";
                    echo "</li></a>";
                }
            }
        }
    }

}

?>