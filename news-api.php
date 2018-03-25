<?php
    /*
    * Doc Strings are pulled from the python lib found here:
    * -> https://github.com/mattlisiv/newsapi-python/blob/master/newsapi/newsapi_client.py
    *
    * File: news-api.php
    * Author: K.B. Carte
    * Author URL: https://kbcarte.com
    * Date: March 2018
    * License: MIT
    *
    */
    class NewsApiClient {

        private $api_key;
        public $api_url;

        public function __construct($api_key, $api_url='https://newsapi.org/v2/'){
            /* 
            * api key should not be in these files, either have a separate file
            * containing it, or do like I did and set it as an environment var
            */
            $this->api_key = 'apiKey=' . $api_key;
            $this->api_url = $api_url;
        }

        public function get_top_headlines($args=array()){
            /*
            * Returns live top and breaking headlines for a country, specific category in a country,
            * single source, or multiple sources..
            *
            * Optional parameters:
            *   (str) q - return headlines w/ specified coin! Valid values are:
            *       'bitcoin', 'etheremum', 'ripple', 'bitcoin cash', etc.
            *                
            *    (array) sources - return headlines of news sources! some Valid values are:
            *       'bbc-news', 'the-verge', 'abc-news', 'crypto-coins-news', etc...
            *       Full list found here: https://newsapi.org/sources
			*				
			*	(str) language - The 2-letter ISO-639-1 code of the language you want to get headlines for. Valid values are:
			*	    'ar','de','en','es','fr','he','it','nl','no','pt','ru','se','ud','zh'
            *                
            *    (str) country - The 2-letter ISO 3166-1 code of the country you want to get headlines! Valid values are:
            *       'ae','ar','at','au','be','bg','br','ca','ch','cn','co','cu','cz','de','eg','fr','gb','gr',
            *       'hk','hu','id','ie','il','in','it','jp','kr','lt','lv','ma','mx','my','ng','nl','no','nz',
            *       'ph','pl','pt','ro','rs','ru','sa','se','sg','si','sk','th','tr','tw','ua','us'
			*					
			*	(str) category - The category you want to get headlines for! Valid values are:
			*       'business','entertainment','general','health','science','sports','technology'
			*					
			*	(int) pageSize - The number of results to return per page (request). 20 is the default, 100 is the maximum. 
			*					
		    *	(int) page - Use this to page through the results if the total results found is greater than the page
            */

            if (!empty($args['sources'])){
                $args['sources'] = implode(',', $args['sources']);
            }

            $_url = $this->api_url . 'top-headlines?' . $this->api_key;
            foreach ($args as $key=>$item){
                if (!is_null($item) and !empty($item)){
                    $_url .= '&' . $key . '=' .$item;
                }
            }

            $json = file_get_contents($_url);
            $obj = json_decode($json, true);
            return $obj;
        }


        public function get_everything($args=array()){
            /*     
            * Search through millions of articles from over 5,000 large and small news sources and blogs.
            * Optional parameters:
            *   (str) q - return headlines w/ specified coin! Valid values are:
            *       'bitcoin', 'etheremum', 'ripple', 'bitcoin cash', etc.
            *                    
            *   (array) sources - return headlines of news sources! some Valid values are:
            *       'bbc-news', 'the-verge', 'abc-news', 'crypto-coins-news', etc...
            *       Full list found here: https://newsapi.org/sources
            *					
            *   (str) domains - A comma-seperated string of domains to restrict the search to.
            *       (eg bbc.co.uk, techcrunch.com, engadget.com) 
            * 
            *   (str) from - A date and optional time for the oldest article allowed.
            *       (e.g. 2018-03-05 or 2018-03-05T03:46:15)
            *		
            *   (str) to - A date and optional time for the newest article allowed.
            *					
            *   (str) language - The 2-letter ISO-639-1 code of the language you want to get headlines for:
            * 	    'ar','de','en','es','fr','he','it','nl','no','pt','ru','se','ud','zh'
            *						
            *   (str) sortBy - The order to sort the articles in. Valid values are:
            *       'relevancy','popularity','publishedAt', 'relevancy'
            *						
            *   (int or str) pageSize - The number of results to return per page (request). 20 is the default, 100 is the maximum.	
            *	
            *   (int or str) page - Use this to page through the results if the total results found is greater than the page size.
            */

            if (!empty($args['sources'])){
                $args['sources'] = implode(',', $args['sources']);
            }

            $_url = $this->api_url . 'everything?' . $this->api_key;
            foreach ($args as $key=>$item){
                if (!is_null($item) and !empty($item)){
                    $_url .= '&' . $key . '=' .$item;
                }
            }

            $json = file_get_contents($_url);
            $obj = json_decode($json, true);
            return $obj;
            
        }

        public function get_sources($args=array()){
            /*
            * Returns the subset of news publishers that top headlines...
            * Optional parameters:
            *   (str) language - The 2-letter ISO-639-1 code of the language you want to get headlines for. Valid values are:
			*	    'ar','de','en','es','fr','he','it','nl','no','pt','ru','se','ud','zh'
            *                
            *    (str) country - The 2-letter ISO 3166-1 code of the country you want to get headlines! Valid values are:
            *       'ae','ar','at','au','be','bg','br','ca','ch','cn','co','cu','cz','de','eg','fr','gb','gr',
            *       'hk','hu','id','ie','il','in','it','jp','kr','lt','lv','ma','mx','my','ng','nl','no','nz',
            *       'ph', 'pl','pt','ro','rs','ru','sa','se','sg','si','sk','th','tr','tw','ua','us'
			*					
			*	(str) category - The category you want to get headlines for! Valid values are:
			*	    'business','entertainment','general','health','science','sports','technology'
            */

            $_url = $this->api_url . 'sources?' . $this->api_key;
            foreach ($args as $key=>$item){
                if (!is_null($item) and !empty($item)){
                    $_url .= '&' . $key . '=' .$item;
                }
            }

            $json = file_get_contents($_url);
            $obj = json_decode($json, true);
            return $obj;

        }
    }